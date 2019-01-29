<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'status',
        'created_at'
    ];

    /**
     * Define the relationship to homes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function homes()
    {
        return $this->belongsToMany(Home::class, 'announcement_targets');
    }

    /**
     * Define the relationship to homes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function areas()
    {
        return $this->belongsToMany(Area::class, 'announcement_targets');
    }

    /**
     * Define the relationship to comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(AnnouncementComment::class);
    }

    /**
     * Add areas to announcement targets.
     *
     * @param array $areas
     */
    public function addAreas(array $areas)
    {
        foreach ($areas as $area) {
            $this->areas()->attach($area);
        }
    }

    /**
     * Add homes to announcement targets.
     *
     * @param array $homes
     */
    public function addHomes(array $homes)
    {
        foreach ($homes as $home) {
            $this->homes()->attach($home);
        }
    }

    /**
     * Determine if the announcement is posted to everyone.
     *
     * @return bool
     */
    public function postedToEveryone()
    {
        return $this->areas->count() == 0 && $this->homes->count() == 0;
    }

    /**
     * Get where the announcement is posted to.
     *
     * @return mixed
     */
    public function postedTo()
    {
        return $this->areas->merge($this->homes);
    }

    /**
     * Get where the announcement is being posted to.
     *
     * @return string
     */
    public function getTo()
    {
        if ($this->postedToEveryone()) {
            return "everyone";
        }

        if ($this->areas->count() > 0) {
            return "your area";
        }

        if ($this->homes->count() > 0) {
            return "your home";
        }
    }

    /**
     * Return the HTML badge of the announcement's status.
     *
     * @return string
     */
    public function showStatus()
    {
        switch ($this->status) {
            case 0:
                return '<span class="badge badge-secondary">Not Posted</span>';
            case 1:
                return '<span class="badge badge-success">Posted</span>';
            case 2:
                return '<span class="badge badge-danger">Hidden</span>';
        }
    }

    /**
     * Hide the announcement.
     *
     * @return bool
     */
    public function hide()
    {
        return $this->update([
            'status'    => 2
        ]);
    }

    /**
     * Show the announcement.
     *
     * @return bool
     */
    public function show()
    {
        return $this->update([
            'created_at' => now(),
            'status'     => 1
        ]);
    }

    /**
     * Determine if the announcement is hidden.
     *
     * @return bool
     */
    public function isHidden()
    {
        return (int) $this->status === 2;
    }

    /**
     * Determine if the announcement is showing.
     *
     * @return bool
     */
    public function isShowing()
    {
        return (int) $this->status === 1;
    }
}
