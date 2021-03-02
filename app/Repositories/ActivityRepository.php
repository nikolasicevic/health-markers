<?php

namespace App\Repositories;

use App\Interfaces\ActivityRepositoryInterface;
use App\Models\Activity;
use Carbon\Carbon;

/**
 * 
 */
class ActivityRepository implements ActivityRepositoryInterface
{
    /**
     * Get all activities.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return Activity::all();
    }

    /**
     * Get activity by id.
     *
     * @param int $id
     * @return \App\Models\Activity
     */
    public function find($id)
    {
        return Activity::findOrFail($id);
    }
}
