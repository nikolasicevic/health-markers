<?php

namespace App\Repositories;

use App\Interfaces\MealRepositoryInterface;
use App\Models\Meal;
use Carbon\Carbon;

/**
 * 
 */
class MealRepository implements MealRepositoryInterface
{
    /**
     * Store data about a meal.
     *
     * @param array $data
     * @return \App\Model\Meal
     */
    public function store($data)
    {
        $meal = new Meal;

        $meal->name = $data['name'];
        $meal->time = $data['time'];
        $meal->day_id = $data['day_id'];

        $meal->save();

        return $meal;
    }

    /**
     * Update data about a meal.
     *
     * @param int $id
     * @param array $data
     * @return \App\Model\Meal
     */
    public function update($id, $data)
    {
        $meal = $this->find($id);

        $meal->name = $data['name'];
        $meal->time = $data['time'];

        $meal->save();

        return $meal;
    }

    /**
     * Find meal by id.
     *
     * @param int $id
     * @return \App\Model\Meal
     */
    public function find($id)
    {
        return Meal::findOrFail($id);
    }

    /**
     * Delete a meal by id.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        return Meal::destroy($id);
    }
}
