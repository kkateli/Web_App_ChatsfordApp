<?php

namespace App\Models;

use function foo\func;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are allowed to be changed.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'username',
        'password',
        'type',
        'gender',
        'date_of_birth',
        'status',
        'home_id'
    ];

    /**
     * The attributes that should be hidden from arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'date_of_birth'
    ];

    /**
     * Define the relationship between a user and the events they may be interested in.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function interestedEvents()
    {
        return $this->belongsToMany(Event::class);
    }

    /**
     * Define the relationship between a user and the house they live at.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function home()
    {
        return $this->belongsTo(Home::class);
    }

    /**
     * Define the relationship a user has to its submitted maintenance jobs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function maintenance_jobs()
    {
        return $this->hasMany(MaintenanceJob::class);
    }

    /**
     * Define the relationship a user has to its complaints.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    /**
     * Get the user's announcements
     */
    public function getAnnouncements()
    {
        $home = $this->home;

        if (! is_null($home)) {
            // get all that relate to this home
            $homeAnnouncements = $this->home->announcements()->where('status', 1)->withCount('comments')->with('homes', 'areas')->get();

            if (! is_null($this->home->area)) {
                $areaAnnouncements = $this->home->area->announcements()->where('status', 1)->withCount('comments')->with('homes', 'areas')->get();
            } else {
                $areaAnnouncements = collect();
            }
        } else {
            $homeAnnouncements = collect();
            $areaAnnouncements = collect();
        }

        // get all that all residents should see
        $residentAnnouncements = Announcement::where('status', 1)->whereDoesntHave('homes')->whereDoesntHave('areas')->withCount('comments')->get();

        $announcements = collect();

        $residentAnnouncements->each(function ($announcement) use ($announcements) {
            $announcements->push($announcement);
        });

        $areaAnnouncements->each(function ($announcement) use ($announcements) {
            $announcements->push($announcement);
        });

        $homeAnnouncements->each(function ($announcement) use ($announcements) {
            $announcements->push($announcement);
        });

        return $announcements->sortByDesc('created_at');
    }

    /**
     * Get the name of the user.
     *
     * @return string
     */
    public function name()
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * Get the type of the user.
     *
     * @return mixed
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * Determine if the user is a resident.
     *
     * @return bool
     */
    public function isResident()
    {
        return $this->type === "resident";
    }

    /**
     * Determine if the user is part of management.
     *
     * @return bool
     */
    public function isManagement()
    {
        return $this->type === "management";
    }

    /**
     * Determine if the user is part of maintenance.
     *
     * @return bool
     */
    public function isMaintenance()
    {
        return $this->type === "maintenance";
    }

    /**
     * Scope the given query to residents only.
     *
     * @param $query
     * @return mixed
     */
    public function scopeResidents($query)
    {
        return $query->where('type', 'resident');
    }

    /**
     * Scope the given query to employees.
     *
     * @param $query
     * @return mixed
     */
    public function scopeEmployees($query)
    {
        return $query->where('type', 'management')->orWhere('type', 'maintenance');
    }

    /**
     * Scope the query by the active residents.
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Determine if the user is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return (int) $this->status === 1;
    }

    /**
     * Determine if the user is active.
     *
     * @return bool
     */
    public function isInactive()
    {
        return (int) $this->status === 0;
    }

    /**
     * Register a user's interest.
     *
     * @param Event $event
     */
    public function registerInterest(Event $event)
    {
        $this->interestedEvents()->attach($event);
    }

    /**
     * Deregister a user's interest.
     *
     * @param Event $event
     */
    public function deregisterInterest(Event $event)
    {
        $this->interestedEvents()->detach($event);
    }

    /**
     * Determines if the user has upcoming events.
     *
     * @return bool
     */
    public function hasUpcomingEvents()
    {
        return $this->interestedEvents()->where('start_datetime', '>', DB::raw('now()'))->count() > 0;
    }

    /**
     * Determine if a user has registered interest for an event.
     *
     * @param Event $event
     * @return bool
     */
    public function hasRegisteredInterestFor(Event $event)
    {
        return $this->interestedEvents()->get()->contains('id', $event->id);
    }

    /**
     * Get the url for a given user.
     *
     * // FIXME - this wont be needed when we refactor to common maintenance functionality... #12
     * @return string
     * @throws \Exception
     */
    public function getUrlForAddingCorrespondence()
    {
        if ($this->isManagement()) return route('job.add-correspondence');

        if ($this->isMaintenance()) return route('maintenance.job.add-correspondence');

        throw new \Exception("Something went wrong.");
    }

    /**
     * Get the dashboard route for the user.
     *
     * @return string
     */
    public function getDashboardRoute()
    {
        if ($this->isManagement()) return 'management.dashboard';

        if ($this->isMaintenance()) return 'maintenance.dashboard';

        if ($this->isResident()) return 'resident.dashboard';
    }

    /**
     * Determine what view user route to return.
     *
     * @return string
     */
    public function getViewUserRoute()
    {
        if ($this->isManagement() || $this->isMaintenance()) return 'employee.view';

        return 'resident.view';
    }
}
