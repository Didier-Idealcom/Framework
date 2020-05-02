<?php

namespace Modules\Core\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Permalink extends Model
{
    use Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['active', 'type', 'redirect'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['slug', 'full_path'];

    /**
     * Polymorphic relationship to any entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function entity()
    {
        return $this->morphTo();
    }

    /**
     * Booting the model.
     */
    public static function boot()
    {
        parent::boot();

        static::created(function ($permalink) {
            $locales = array('fr', 'en');
            foreach ($locales as $locale) {
                $translation = $permalink->getNewTranslation($locale);
                $translation->permalink_id = $permalink->id;
                $translation->slug = $permalink->entity->buildSlug($locale);
                $translation->full_path = $permalink->entity->buildPermalink($locale);
                $translation->save();
            }
        });
    }
}
