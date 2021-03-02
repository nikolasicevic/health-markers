<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Day;
use App\Models\SleepSession;
use App\Models\Meal;
use App\Models\ActivitySession;
use Illuminate\Support\Arr;

class DaySeeder extends Seeder
{
    const YEAR = 365;
    const SLEEP_SESSION_START_TIMES = [
        '21:00:00', 
        '21:30:00', 
        '22:00:00', 
        '23:00:30', 
    ];

    const SLEEP_SESSION_END_TIMES = [
        '07:00:00', 
        '07:30:00', 
        '08:00:00',
        '08:30:00',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ubaci prethodnih 365 dana
        for ($i=1; $i <= self::YEAR; $i++) {
            $date = Carbon::now()->subDays($i);

            // svaki dan ima 1 sleep session, 1-3 obroka i 0-3 aktivnosti
            Day::factory()
                ->hasSleepSession(1, [
                    'start' => $date->subDays(1)->format('Y-m-d') . ' ' . Arr::random(self::SLEEP_SESSION_START_TIMES),
                    'end' => $date->addDays(1)->format('Y-m-d') . ' ' . Arr::random(self::SLEEP_SESSION_END_TIMES)
                ])
                ->hasMeals(Arr::random([1, 2, 3]))
                ->hasActivitySessions(Arr::random([0, 1, 2, 3]))
                ->create([
                    'date' => $date->format('Y-m-d')
                ]);
        }
    }
}
