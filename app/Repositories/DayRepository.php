<?php

namespace App\Repositories;

use App\Interfaces\DayRepositoryInterface;
use App\Models\Day;
use App\Models\SleepSession;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * 
 */
class DayRepository implements DayRepositoryInterface
{
    const WEEK = 7;
    const MONTH = 30;
    const QUARTER = 90;

    /**
     * Get all days.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return Day::orderBy('date', 'desc')->get();
    }

    /**
     * Filter given collection of days.
     *
     * @param \Illuminate\Support\Collection $days
     * @param int $sleepDurationLess
     * @param int $sleepDurationGreater
     * @param date $activityDurationLess
     * @param date $activityDurationGreater
     * @return \Illuminate\Support\Collection
     */
    public function filterSearchCollection($days, $sleepDurationLess, $sleepDurationGreater, $activityDurationLess, $activityDurationGreater)
    {
        if ($sleepDurationLess || $sleepDurationGreater || $activityDurationLess || $activityDurationGreater) {
            foreach($days as $key => $day) {
                if(
                    ($sleepDurationLess && !($sleepDurationLess >= $day->sleepSession->sleepDuration())) ||
                    ($sleepDurationGreater && !($sleepDurationGreater <= $day->sleepSession->sleepDuration())) ||
                    ($activityDurationLess && !($activityDurationLess >= $day->activitiesDuration())) ||
                    ($activityDurationGreater && !($activityDurationGreater <= $day->activitiesDuration()))
                ){
                    $days->forget($key);
                }
            }
        }

        return $days;
    }

    /**
     * Get data directly from the DB based on different criteria.
     *
     * @param int $energyLess
     * @param int $energyGreater
     * @param date $dateBefore
     * @param date $dateAfter
     * @return \Illuminate\Support\Collection
     */
    public function getQueryData($energyLess, $energyGreater, $dateBefore, $dateAfter)
    {
        return Day::when($energyLess, function($query, $energyLess){
                        return $query->where('energy_level', '<=', $energyLess);
                    })
                    ->when($energyGreater, function($query, $energyGreater){
                        return $query->where('energy_level', '>=', $energyGreater);
                    })
                    ->when($dateBefore, function($query, $dateBefore){
                        return $query->where('date', '<=', $dateBefore);
                    })
                    ->when($dateAfter, function($query, $dateAfter){
                        return $query->where('date', '>=', $dateAfter);
                    })
                    ->orderBy('date', 'desc')
                    ->get();
    }

    /**
     * Search days per different criterion.
     *
     * @param array $data
     * @return \App\Models\Day
     */
    public function search($data)
    {
        $energyLess = $data['energy_less'];
        $energyGreater = $data['energy_greater'];
        $dateBefore = $data['date_before'];
        $dateAfter = $data['date_after'];
        $sleepDurationLess = round($data['sleep_duration_less'], 2);
        $sleepDurationGreater = round($data['sleep_duration_greater'], 2);
        $activityDurationLess = round($data['activity_duration_less'], 2);
        $activityDurationGreater = round($data['activity_duration_greater'], 2);

        $days = $this->getQueryData($energyLess, $energyGreater, $dateBefore, $dateAfter);
        $days = $this->filterSearchCollection($days, $sleepDurationLess, $sleepDurationGreater, $activityDurationLess, $activityDurationGreater);

        return $days;
    }

    /**
     * Store data about the day and about the related sleep seesion.
     *
     * @return \App\Models\Day
     */
    public function create()
    {
        $day = $this->lastDay();
        $today = Carbon::today()->format('Y-m-d');
        $sleepSession = new SleepSession([]);

        if (!isset($day) || $day->date !== $today) {
            $day = Day::create(['date' => $today]);
            $day->sleepSession()->save($sleepSession);
        }

        return $day;
    }

    /**
     * Find the day with the lates date.
     *
     * @return \App\Models\Day
     */
    public function lastDay()
    {
        return Day::orderBy('date', 'desc')->first();
    }

    /**
     * Get limited numbers of previous days.
     *
     * @return \Illuminate\Support\Collection
     */
    public function lastDays($number)
    {
        return Day::orderBy('date', 'desc')->take($number)->get();
    }

    /**
     * Get day by id.
     *
     * @param int $id
     * @return \App\Models\Day
     */
    public function find($id)
    {
        return Day::findOrFail($id);
    }

    /**
     * Update data about the day.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Day
     */
    public function update($id, $data)
    {
        $day = $this->find($id);

        $day->energy_level = $data['energy_level'];

        $day->save();

        return $day;
    }

    /**
     * Initialize data array.
     *
     * @param int $dayCount
     * @return array
     */
    public function initializeDataArray($dayCount)
    {
        return [
            'day_count' => $dayCount,
            'avgs' => [
                'avg_sleep_duration' => 0,
                'avg_sleep_start' => 0,
                'avg_sleep_end' => 0,
                'avg_meal_number' => 0,
                'avg_activity_duration' => 0,
                'avg_energy_level' => 0,
            ],
            'totals' => [
                'total_sleep_duration' => 0,
                'sleep_start_array' => [],
                'sleep_end_array' => [],
                'total_meal_number' => 0,
                'total_activity_duration' => 0,
                'total_energy_level' => 0,
            ],
            'chart_values' => [
                'date_array' => [],
                'sleep_session_array' => [],
                'meal_number_array' => [],
                'activity_duration_array' => [],
                'energy_level_array' => [],
            ], 
        ];
    }

    /**
     * Increment total values.
     *
     * @param array $totals
     * @param \App\Models\Day $day
     * @return array
     */
    public function incrementTotals($totals, $day)
    {
        $totals['total_sleep_duration'] += $day->sleepSession->sleepDuration();
        array_push($totals['sleep_start_array'], date('H:i', strtotime($day->sleepSession->start)));
        array_push($totals['sleep_end_array'], date('H:i', strtotime($day->sleepSession->end)));
        $totals['total_meal_number'] += $day->meals->count();
        $totals['total_activity_duration'] += $day->activitiesDuration();
        $totals['total_energy_level'] += $day->energy_level;

        return $totals;
    }

    /**
     * Increment chart values.
     *
     * @param array $chartValues
     * @param \App\Models\Day $day
     * @return array
     */
    public function incrementChartValues($chartValues, $day)
    {
        array_push($chartValues['date_array'], date('m.d.Y', strtotime($day->date))); 
        array_push($chartValues['sleep_session_array'], $day->sleepSession->sleepDuration()); 
        array_push($chartValues['meal_number_array'], $day->meals->count());  
        array_push($chartValues['activity_duration_array'], $day->activitiesDuration()); 
        array_push($chartValues['energy_level_array'], $day->energy_level); 

        return $chartValues;
    }

    /**
     * Calculate average values.
     *
     * @param array $totals
     * @param int $dayCount
     * @return array
     */
    public function calculateAverages($totals, $dayCount)
    {
        $midIndex = floor($dayCount / 2);

        sort($totals['sleep_start_array']);
        sort($totals['sleep_end_array']);

        return [
            'avg_sleep_duration' => round($totals['total_sleep_duration'] / $dayCount, 2),
            'avg_sleep_start' => $totals['sleep_start_array'][$midIndex],
            'avg_sleep_end' => $totals['sleep_end_array'][$midIndex],
            'avg_meal_number' => round($totals['total_meal_number'] / $dayCount, 2),
            'avg_activity_duration' => round($totals['total_activity_duration'] / $dayCount, 2),
            'avg_energy_level' => round($totals['total_energy_level'] / $dayCount, 2),
        ];
    }

    /**
     * Set data about total values, average values and chart values if requested.
     *
     * @param \Illuminate\Support\Collection $days
     * @param boolean $withChartData
     * @return array
     */
    public function setData($days, $withChartData = false)
    {
        $dayCount = $days->count();
        $data = $this->initializeDataArray($dayCount);

        if ($dayCount > 0) {
            foreach ($days as $day) {
                $data['totals'] = $this->incrementTotals($data['totals'], $day);

                if ($withChartData) {
                    $data['chart_values'] = $this->incrementChartValues($data['chart_values'], $day);
                }
            }

            $data['avgs'] = $this->calculateAverages($data['totals'], $dayCount);
        }

        return $data;
    }
}
