<?php

namespace App\Repositories;

use App\Interfaces\ActivitySessionRepositoryInterface;
use App\Models\ActivitySession;
use Carbon\Carbon;

/**
 * 
 */
class ActivitySessionRepository implements ActivitySessionRepositoryInterface
{
    /**
     * Store data about activity session.
     *
     * @param array $data
     * @return \App\Models\ActivitySession
     */
    public function store($data)
    {
        $activitySession = new ActivitySession;

        $activitySession->activity_id = $data['activity_id'];
        $activitySession->duration_hrs = $data['duration_hrs'];
        $activitySession->day_id = $data['day_id'];

        $activitySession->save();

        return $activitySession;
    }

    /**
     * Update data about activity session.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\ActivitySession
     */
    public function update($id, $data)
    {
        $activitySession = $this->find($id);

        $activitySession->activity_id = $data['activity_id'];
        $activitySession->duration_hrs = $data['duration_hrs'];

        $activitySession->save();

        return $activitySession;
    }

    /**
     * Find activity session by id.
     *
     * @param int $id
     * @return \App\Models\ActivitySession
     */
    public function find($id)
    {
        return ActivitySession::findOrFail($id);
    }

    /**
     * Store data about activity session.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        return ActivitySession::destroy($id);
    }
}
