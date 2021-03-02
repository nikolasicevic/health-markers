<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Day;
use App\Models\ActivitySession;

class Activity extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the day on which a activity session occured.
     */
    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    /**
     * Get activity session.
     */
    public function activitySession()
    {
        return $this->hasOne(ActivitySession::class);
    }
}
