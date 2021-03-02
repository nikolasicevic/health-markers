<?php

namespace Database\Factories;

use App\Models\Day;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class DayFactory extends Factory
{
    const ENERGY_LEVELS = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Day::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'energy_level' => Arr::random(self::ENERGY_LEVELS),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
