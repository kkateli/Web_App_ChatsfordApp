<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuDay extends Model
{
    protected $fillable = [
        'menu_id',
        'date',
        'lunch',
        'dinner'
    ];

    protected $dates = [
        'date'
    ];

    /**
     * Define the relationship this day is related to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
