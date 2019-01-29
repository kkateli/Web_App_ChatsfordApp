<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceType extends Model
{
    protected $fillable = [
        'name',
        'icon_type'
    ];

    /**
     * Define the relationship a maintenance type has to its jobs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function maintenance_jobs()
    {
        return $this->hasMany(MaintenanceJob::class, 'type');
    }
}
