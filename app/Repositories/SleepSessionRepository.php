<?php

namespace App\Repositories;

use App\Interfaces\SleepSessionRepositoryInterface;
use App\Models\SleepSession;
use Carbon\Carbon;

/**
 * 
 */
class SleepSessionRepository implements SleepSessionRepositoryInterface
{
    /**
     * Update data about a sleeep session.
     *
     * @param int $id
     * @param array $data
     * @return \App\Model\SleepSession
     */
    public function update($id, $data)
    {
        $sleepSession = SleepSession::findOrFail($id);

        $sleepSession->start = str_replace('T', ' ', $data['start']);
        $sleepSession->end = str_replace('T', ' ', $data['end']);

        $sleepSession->save();

        return $sleepSession;
    }

    /**
     * Find sleep session by id.
     *
     * @param int $id
     * @return \App\Model\SleepSession
     */
    public function find($id)
    {
        return SleepSession::findOrFail($id);
    }
}
