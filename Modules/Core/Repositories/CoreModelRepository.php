<?php

namespace Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CoreModelRepository implements CoreCrudRepositoryInterface, CoreTranslatableRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    // Get the associated model
    public function getModel(): Model
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    // Get all instances of model
    public function all(): Collection
    {
        return $this->model->all();
    }

    // Load instances of model with pagination
    public function paginate($n): Collection
    {
        return $this->model->paginate($n);
    }

    // Find record in the database with the given id
    public function find(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    // Create a new record in the database
    public function create(array $inputs): Model
    {
        $inputs = $this->processTranslations($inputs);

        return $this->model->create($inputs);
    }

    // Update record in the database
    public function update(int $id, array $inputs): bool
    {
        $inputs = $this->processTranslations($inputs);

        return $this->find($id)->update($inputs);
    }

    // Switch "on/off" a record field in the database
    public function switch(int $id, string $field = 'active'): bool
    {
        $record = $this->find($id);
        $inputs = [];
        $inputs[$field] = $record->$field === 'Y' ? 'N' : 'Y';

        return $record->update($inputs);
    }

    // Remove record from the database
    public function delete(int $id): ?bool
    {
        return $this->find($id)->delete();
    }

    public function processTranslations(array $inputs): array
    {
        unset($inputs['save']);
        if (! empty($this->model->translatedAttributes)) {
            $inputs = $this->formatInputTranslations($inputs);
        }

        return $inputs;
    }

    private function formatInputTranslations(array $inputs): array
    {
        $locales = [];
        $translations = [];
        $languages = session()->get('languages');

        foreach ($languages as $language) {
            $locales[] = $language->alpha2;
        }

        foreach ($locales as $locale) {
            if (! isset($translations[$locale])) {
                $translations[$locale] = [];
            }

            foreach ($inputs as $key => $value) {
                if (strpos($key, $locale.'_') === 0) {
                    $translations[$locale][substr($key, 3)] = $value;
                    unset($inputs[$key]);
                }
            }
        }

        return array_merge($inputs, $translations);
    }
}
