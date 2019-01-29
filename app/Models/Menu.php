<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'status'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    /**
     * Define the relationship to MenuDay.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function days()
    {
        return $this->hasMany(MenuDay::class);
    }

    /**
     * Return the period of the menu.
     *
     * @return string
     */
    public function period()
    {
        return $this->start_date->format('dS M') . ' to ' . $this->end_date->format('dS M');
    }

    /**
     * Determine if this instance of the menu is the current menu.
     *
     * @return bool
     */
    public function isCurrent()
    {
        return now()->between($this->start_date, $this->end_date);
    }
}
