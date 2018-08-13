<?php

namespace Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Model;

class CoreRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function load($n)
    {
        return $this->model->paginate($n);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $inputs)
    {
        $inputs = $this->formatInputTranslations($inputs);
        return $this->model->create($inputs);
    }

    public function update($id, array $inputs)
    {
        $inputs = $this->formatInputTranslations($inputs);
        $this->find($id)->update($inputs);
    }

    public function delete($id)
    {
        $this->find($id)->delete();
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
