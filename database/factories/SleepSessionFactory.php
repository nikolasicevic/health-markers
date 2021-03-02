<?php

namespace Database\Factories;

use App\Models\SleepSession;
use Illuminate\Database\Eloquent\Factories\Factory;

class SleepSessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SleepSession::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
