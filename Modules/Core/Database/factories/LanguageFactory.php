<?php

namespace Modules\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Core\Entities\Language;

class LanguageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Language::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alpha2' => Str::random(2),
            'alpha3' => Str::random(3),
            'locale' => $this->faker->locale(),
            'name' => $this->faker->name(),
            'format_date_small' => '%d/%m/%Y',
            'format_date_long' => '%d %B %Y',
            'format_date_time' => '%d/%m/%Y %H:%i:%s',
        ];
    }
}
