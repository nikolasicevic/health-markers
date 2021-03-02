<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Day;
use Carbon\Carbon;

class SleepSession extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sleep_sessions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'start',
        'end',
    ];

    /**
     * Get the day on which a sleep session occured.
     */
    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    /**
     * Calculate total amount of sleep.
     *
     * @return float
     */
    public function sleepDuration()
    {
        $duration = 0;

        if (isset($this->start) && isset($this->end)) {
            $start = Carbon::create($this->start);
            $end = Carbon::create($this->end);

            $duration = round(($start->diffInMinutes($end) / 60), 2);
        }

        return $duration;
    }
}
