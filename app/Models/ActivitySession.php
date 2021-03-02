<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;

class ActivitySession extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activity_sessions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'duration_hrs',
        'intensity',
        'activity_id',
        'day_id',
    ];

    /**
     * Get the day of the session.
     */
    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    /**
     * Get activity.
     */
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
