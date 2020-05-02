<?php

namespace Modules\Core\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Core\Entities\Permalink;

trait HasPermalink
{
    /**
     * Automatic permalink management.
     *
     * @var bool
     */
    protected $permalinkHandling = true;

    /**
     * Permalink translation management.
     *
     * @var bool
     */
    protected $translationHandling = false;

    public static function bootHasPermalink(): void
    {
        static::saved(function (Model $model) {
            if (!$model->permalinkHandling()) {
                return;
            }

            if (!method_exists($model, 'permalinkSlug')) {
                dump('Le model doit implémenter le contrat Modules\Core\Contracts\Permalinkable');
                return;
            }

            if (property_exists($model, 'translatedAttributes')) {
                $model->enableTranslationHandling();
            }

            if ($model->wasRecentlyCreated) {
                $model->createPermalink();
            } else {
                $model->updatePermalink();
            }
        });
    }

    /**
     * Determine if automatic permalink handling should be done.
     *
     * @return bool
     */
    public function permalinkHandling(): bool
    {
        return $this->permalinkHandling;
    }

    /**
     * Enable automatic permalink handling.
     *
     * @return $this
     */
    public function enablePermalinkHandling()
    {
        $this->permalinkHandling = true;

        return $this;
    }

    /**
     * Disable automatic permalink handling.
     *
     * @return $this
     */
    public function disablePermalinkHandling()
    {
        $this->permalinkHandling = false;

        return $this;
    }

    /**
     * Determine if permalink translation handling should be done.
     *
     * @return bool
     */
    public function translationHandling(): bool
    {
        return $this->translationHandling;
    }

    /**
     * Enable permalink translation handling.
     *
     * @return $this
     */
    public function enableTranslationHandling()
    {
        $this->translationHandling = true;

        return $this;
    }

    /**
     * Relation to the permalinks table.
     *
     * @return mixed
     */
    public function permalinks()
    {
        return $this->morphMany(Permalink::class, 'entity');
    }

    /**
     * Create the permalink for the current entity.
     */
    public function createPermalink()
    {
        $permalink = $this->permalinks()->create();
    }

    /**
     * Update the permalink for the current entity.
     */
    public function updatePermalink()
    {
        $needUpdate = $this->needUpdate();

        if ($needUpdate) {
            $permalink = $this->permalinks()->create();

            // Redirect others permalinks
            $this->permalinks()
                 ->where('id', '<>', $permalink->id)
                 ->update(['redirect' => $permalink->id]);
        }
    }

    /**
     * Check if the entity needs permalink update.
     *
     * @return bool
     */
    public function needUpdate(): bool
    {
        // Verify entity changes
        $entityChanges = $this->detectEntityChanges();

        if ($entityChanges) {
            // Verify slug changes
            $slugChanges = $this->detectSlugChanges();

            if ($slugChanges) {
                $checkOld = $this->checkOldPermalinks();
                return !$checkOld;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Detect if an entity attribute used to build the permalink has changed.
     *
     * @return bool
     */
    public function detectEntityChanges(): bool
    {
        $changes = $this->getChanges();
        if ($this->translationHandling()) {
            foreach ($this->translations as $translation) {
                $changes = array_merge($changes, $translation->getChanges());
            }
        }

        $intersect = array_intersect($this->permalinkSlug(), array_keys($changes));

        return !empty($intersect);
    }

    /**
     * Detect if the entity's slug has changed.
     *
     * @return bool
     */
    public function detectSlugChanges(): bool
    {
        $slugChanges = false;
        foreach ($this->getPermalink()->translations as $translation) {
            if ($translation->slug != $this->buildSlug($translation->locale)) {
                $slugChanges = true;
                break;
            }
        }

        return $slugChanges;
    }

    /**
     * Check old permalinks to prevent duplication.
     * Returns true when an identical old permalink is found.
     *
     * @return bool
     */
    public function checkOldPermalinks(): bool
    {
        foreach ($this->permalinks as $permalink) {
            $identical = true;
            foreach ($permalink->translations as $translation) {
                if ($translation->slug != $this->buildSlug($translation->locale)) {
                    $identical = false;
                    break;
                }
            }

            if ($identical) {
                $permalink->redirect = NULL;
                $permalink->save();

                // Redirect others permalinks
                $this->permalinks()
                     ->where('id', '<>', $permalink->id)
                     ->update(['redirect' => $permalink->id]);

                return true;
            }
        }
        return false;
    }

    /**
     * Build the entity's slug.
     *
     * @param string $locale
     *
     * @return string
     */
    public function buildSlug($locale = null): string
    {
        $slug = '';
        foreach ($this->permalinkSlug() as $permalinkAttribute) {
            if (array_key_exists($permalinkAttribute, $this->attributes)) {
                if (preg_match('#^[0-9]{4}-[0-9]{2}-[0-9]{2}(.*)$#', $this->$permalinkAttribute)) {
                    $slug .= substr($this->$permalinkAttribute, 0, 10) . ' ';
                } else {
                    $slug .= $this->$permalinkAttribute . ' ';
                }
            } elseif (!empty($this->translatedAttributes)) {
                $slug .= $this->translate($locale)->$permalinkAttribute . ' ';
            }
        }
        return Str::slug($slug);
    }

    /**
     * Build the entity's permalink.
     *
     * @param string $locale
     *
     * @return string
     */
    public function buildPermalink($locale = null): string
    {
        // TODO
        return $this->buildSlug($locale);
    }

    public function getPermalink()
    {
        if (empty($this->permalinks)) {
            return null;
        }

        foreach ($this->permalinks as $permalink) {
            if (empty($permalink->redirect)) {
                return $permalink;
            }
        }
    }
}
