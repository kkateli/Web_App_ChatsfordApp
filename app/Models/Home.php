<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = [
        'name',
        'number',
        'area_id'
    ];

    /**
     * Define the relationship that a home has with an area.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Define the relationship the home has to a resident.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function residents()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Define the relationship the home has to a job.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function maintenance_jobs()
    {
        return $this->hasMany(MaintenanceJob::class);
    }

    /**
     * Define the relationship a home has to its announcements.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function announcements()
    {
        return $this->belongsToMany(Announcement::class, 'announcement_targets');
    }

    /**
     * Return the address of the home.
     *
     * @return string
     */
    public function address()
    {
        return $this->name;
    }

    /**
     * Assign an area to a home.
     *
     * @param Area $area
     */
    public function assignArea(Area $area)
    {
        $this->area()->associate($area->id)->save();
    }
}
