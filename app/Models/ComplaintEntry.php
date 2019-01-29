<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintEntry extends Model
{
    protected $fillable = [
        'complaint_id',
        'user_id',
        'comment',
        'status_changed'
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
     * Determine if this entry is an event.
     *
     * @return bool
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
