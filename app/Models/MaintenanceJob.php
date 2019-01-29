<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceJob extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'user_id',
        'status',
        'home_id',
        'area_id'
    ];

    /**
     * Define the relationship a job has to the user that submitted it.
     */
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Define the relationship a job has to its correspondence.
     */
    public function entries()
    {
        return $this->hasMany(MaintenanceJobEntry::class);
    }

    /**
     * Define the relationship a job has to its job type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maintenance_type()
    {
        return $this->belongsTo(MaintenanceType::class, 'type');
    }

    /**
     * Define the relationship a job has to its address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function home()
    {
        return $this->belongsTo(Home::class);
    }

    /**
     * Define the relationship a job has to an area.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get the address in question for this job.
     *
     * @return string
     */
    public function getAddress()
    {
        if ($this->home_id) {
            return $this->home->name;
        }

        if ($this->area_id) {
            return $this->area->name . " (area)";
        }

        if ($this->user_id) {
            return optional($this->submittedBy->home)->address();
        }

        return "Not set";
    }

    /**
     * Scope open jobs.
     *
     * @param $query
     * @return mixed
     */
    public function scopeOpen($query)
    {
        return $query->where('status', 'submitted')->orWhere('status', 'in_progress');
    }

    /**
     * Scope closed jobs.
     *
     * @param $query
     * @return mixed
     */
    public function scopeClosed($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Determine whether the job is in progress.
     *
     * @return bool
     */
    public function inProgress()
    {
        return $this->status === "in_progress";
    }

    /**
     * Determine whether the job is in progress.
     *
     * @return bool
     */
    public function isComplete()
    {
        return $this->status === "completed";
    }

    /**
     * Display the current status of the job.
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
