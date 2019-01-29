<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Define the relationship an area has to its homes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function homes()
    {
        return $this->hasMany(Home::class);
    }

    /**
     * Define the relationship an area has to its announcements.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function announcements()
    {
        return $this->belongsToMany(Announcement::class, 'announcement_targets');
    }
}
