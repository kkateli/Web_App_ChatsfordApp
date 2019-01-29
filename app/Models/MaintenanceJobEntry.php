<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceJobEntry extends Model
{
    protected $fillable = [
        'comment',
        'status_changed',
        'user_id'
    ];

    protected $touches = [
        'maintenanceJob'
    ];

    /**
     * Define the relationship to the user that is posting this reply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship an entry has to its job.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maintenanceJob()
    {
        return $this->belongsTo(MaintenanceJob::class);
    }

    /**
     * Determine if it's the current logged in user.
     *
     * @return bool
     */
    public function notYou()
    {
        return $this->user_id !== auth()->id();
    }

    /**
     * Who updated the ticket?
     *
     * @return mixed
     */
    public function by()
    {
        return $this->user->name();
    }

    /**
     * Determine if this entry is a comment.
     *
     * @return bool
     */
    public function isComment()
    {
        return isset($this->comment);
    }

    /**
     * Determine if this entry is an event (such as changing the status)
     */
    public function isEvent()
    {
        return isset($this->status_changed) && ! is_null($this->status_changed);
    }

    /**
     * What happened with the event?
     *
     * @return string
     */
    public function event()
    {
        switch ($this->status_changed) {
            case "in_progress":
                return "set to In Progress";
            case "completed":
                return "closed";
            case "submitted":
                return "reopened";
        }
    }

    /**
     * Return when the event occurred.
     *
     * @return mixed
     */
    public function when()
    {
        return $this->created_at->diffForHumans();
    }
}
