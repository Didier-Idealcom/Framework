<?php

namespace Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelRepository implements RepositoryInterface
{
    // Model property on class instances
    protected $model;

    // Constructor to bind model to repository
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get the associated model
    public function getModel()
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
    public function all()
    {
        return $this->model->all();
    }

    // Load instances of model with pagination
    public function load($n)
    {
        return $this->model->paginate($n);
    }

    // Find record in the database with the given id
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    // Create a new record in the database
    public function create(array $inputs)
    {
        unset($inputs['save']);
        if (!empty($this->model->translatedAttributes)) {
            $inputs = $this->formatInputTranslations($inputs);
        }
        return $this->model->create($inputs);
    }

    // Update record in the database
    public function update($id, array $inputs)
    {
        unset($inputs['save']);
        if (!empty($this->model->translatedAttributes)) {
            $inputs = $this->formatInputTranslations($inputs);
        }
        return $this->find($id)->update($inputs);
    }

    // Switch "on/off" a record field in the database
    public function switch($id, $field = 'active')
    {
        $record = $this->find($id);
        $inputs[$field] = $record->$field == 'Y' ? 'N' : 'Y';
        return $record->update($inputs);
    }

    // Switch default record field in the database
    public function switchDefault($id, $column = '', $field = 'default')
    {
        $record = $this->find($id);

        $query = DB::table($this->model->getTable());
        if (!empty($column)) {
            $query = $query->where($column, $record->$column);
        }
        $query->update([$field => 'N']);

        return $record->update([$field => 'Y']);
    }

    // Remove record from the database
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    private function formatInputTranslations(array $inputs)
    {
        $locales = array('fr', 'en');
        $translations = array();

        foreach ($locales as $locale) {
            if (!isset($translations[$locale])) {
                $translations[$locale] = array();
            }

            foreach ($inputs as $key => $value) {
                if (strpos($key, $locale . '_') === 0) {
                    $translations[$locale][substr($key, 3)] = $value;
                    unset($inputs[$key]);
                }
            }
        }
//dd($translations);

        return array_merge($inputs, $translations);
    }
}
