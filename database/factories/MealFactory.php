<?php

namespace Database\Factories;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class MealFactory extends Factory
{
    const MEALS = [
        'Kobasice i jaja',
        'Makarone sa sirom',
        'Pilav',
        'Makarone sa tunjevinom',
        'Burek',
        'Sendvic',
        'Ovsene pahuljice',
        'Pohovana piletina',
        'Podvarak',
        'Grasak',
        'Boranija',
        'Pasulj',
        'Sarma',
    ];

    const MEAL_TIMES = [
        '12:00:00',
        '13:00:00',
        '14:00:00',
        '15:00:00',
        '16:00:00',
        '17:00:00',
        '18:00:00',
        '19:00:00',
        '20:00:00',
    ];

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Arr::random(self::MEALS),
            'time' => Arr::random(self::MEAL_TIMES),
        ];
    }
}
