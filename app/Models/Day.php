<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Meal;
use App\Models\ActivitySession;
use App\Models\SleepSession;
use Illuminate\Support\Str;

class Day extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'days';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'energy_level',
    ];

    /**
     * Get the sleep sessions of the day.
     */
    public function sleepSession()
    {
        return $this->hasOne(SleepSession::class);
    }

    /**
     * Get the meals of the day.
     */
    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    /**
     * Get the activities of the day.
     */
    public function activitySessions()
    {
        return $this->hasMany(ActivitySession::class);
    }

    /**
     * Calculate activity duration.
     *
     * @return float
     */
    public function activitiesDuration()
    {
        return ($this->activitySessions->count() > 0) ? $this->activitySessions->sum('duration_hrs') : 0;
    }

    /**
     * Get meal number.
     *
     * @return int
     */
    public function mealNumber()
    {
        return $this->meals->count();
    }
}
