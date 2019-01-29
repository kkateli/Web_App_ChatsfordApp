<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The properties we can change.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'start_datetime',
        'end_datetime',
        'location',
        'cost'
    ];

    protected $dates = [
        'start_datetime',
        'end_datetime'
    ];

    /**
     * Define the relationship to users that have registered their interest.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function interestedUsers()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Scope the query for records today.
     *
     * @param $query
     * @return mixed
     */
    public function scopeToday($query)
    {
        return $query->whereDate('start_datetime', Carbon::now()->toDateString());
    }

    /**
     * Get current events.
     *
     * @param $query
     * @return mixed
     */
    public function scopeCurrent($query)
    {
        return $query->whereDate('start_datetime', '>=', Carbon::now()->toDateString());
    }

    /**
     * Get past events.
     *
     * @param $query
     * @return mixed
     */
    public function scopePast($query)
    {
        return $query->whereDate('start_datetime', '<=', Carbon::now()->toDateString());
    }

    /**
     * Get the time of the event.
     *
     * @return mixed
     */
    public function getTime()
    {
        if (! is_null($this->end_datetime)) {
            return $this->start_datetime->format('jS \o\f F - g:i A') . " - " . $this->end_datetime->format('jS \o\f F - g:i A');
        }

        return $this->start_datetime->format('jS \o\f F - g:i A');
    }
}
