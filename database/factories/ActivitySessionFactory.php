<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\ActivitySession;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ActivitySessionFactory extends Factory
{
    const DURATION_HRS = [0.50, 1.00, 1.50, 2.00, 2.30];
    const INTENSITY = ['high', 'medium', 'low'];
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActivitySession::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $activityIds = Activity::all()->pluck('id')->toArray();

        return [
            'duration_hrs' => Arr::random(self::DURATION_HRS),
            'intensity' => Arr::random(self::INTENSITY),
            'activity_id' => Arr::random($activityIds),
        ];
    }
}
