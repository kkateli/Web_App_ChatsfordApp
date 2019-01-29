<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Complaint extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'status'
    ];

    /**
     * Scope the open complaints.
     *
     * @return mixed
     */
    public function scopeOpen()
    {
        return $this->where('status', 'submitted')->orWhere('status', 'in_progress')->orWhere('status', null);
    }

    /**
     * Scope the open complaints.
     *
     * @return mixed
     */
    public function scopeResolved()
    {
        return $this->where('status', 'completed');
    }

    /**
     * Define the relationship a job has to the user that submitted it.
     */
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Define the relationship has to its entries.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entries()
    {
        return $this->hasMany(ComplaintEntry::class);
    }

    /**
     * Determine if a complaint has been resolved.
     *
     * @return bool
     */
    public function isResolved()
    {
        return $this->status === "completed";
    }

    /**
     * Resolve the complaint.
     *
     * @return bool
     */
    public function resolve()
    {
        return DB::transaction(function() {
            // record the event
            $this->entries()->create([
                'user_id'           => auth()->id(),
                'status_changed'    => 'completed'
            ]);

            return $this->update([
                'status'    => 'completed'
            ]);
        });
    }

    /**
     * Reopen the complaint.
     *
     * @return bool
     */
    public function reopen()
    {
        return DB::transaction(function() {
            // record the event
            $this->entries()->create([
                'user_id'           => auth()->id(),
                'status_changed'    => 'submitted'
            ]);

            return $this->update([
                'status'    => 'submitted'
            ]);
        });
    }

    /**
     * Display the current status of the complaint.
     *
     * @return string
     */
    public function displayStatus()
    {
        switch ($this->status) {
            case "submitted":
                return '<span class="badge badge-secondary">Submitted</span>';

            case "in_progress":
                return '<span class="badge badge-info">In Progress</span>';

            case "completed":
                return '<span class="badge badge-success">Completed</span>';

            default:
                return '<span class="badge badge-secondary">Submitted</span>';
        }
    }
}
