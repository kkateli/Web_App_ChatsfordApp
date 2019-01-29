<?php

// Routes for the application

use Illuminate\Support\Facades\Route;

/**
 * Redirect users from home to login
 */
Route::redirect('/', 'login');

/**
 * In this group of routes, only people who are logged out are able to browse to them (logged in users will get redirected)
 */
Route::middleware('guest')->group(function() {
    /**
     * Define the route for the login page.
     */
    Route::get('login')->uses('Auth\LoginController@login')->name('login');

    /**
     * Define the route for processing the login request.
     */
    Route::post('login')->uses('Auth\LoginController@postLogin')->name('login.post');
});

/**
 * In this group of routes, only people who are logged IN are able to browse to them (logged out users will get redirected)
 */
Route::middleware('auth')->group(function() {

    /**
     * In this group of routes, ONLY management users are allowed to access them. Other users will be redirected.
     */
    Route::middleware('auth.management')->prefix('management')->group(function() {

        /**
         * Define the route for the management dashboard.
         */
        Route::get('dashboard')->uses('Management\DashboardController@dashboard')->name('management.dashboard');
        
        /**
         * Define the route for showing the residents
         */
        Route::get('residents')->uses('Management\ResidentController@index')->name('residents');

        /**
         * Define the route for the add resident view.
         */
        Route::get('residents/add')->uses('Management\ResidentController@add')->name('resident.add');
             
        /**
         * Define the route for showing profile.
         */
        
        Route::get('profile')->uses('Management\ProfileController@index')->name('profiles');

        /**
         * Show the management change password page
         */
        Route::get('profile/change-password')->uses('Management\ProfileController@changePassword')->name('management.change-password');

        /**
         * Process request to change a user's password
         */
        Route::post('profile/change-password')->uses('Management\ProfileController@postChangePassword')->name('management.change-password.post');

        /**
         * Define the route to process the add resident request.
         */
        Route::post('residents/add')->uses('Management\ResidentController@postAdd')->name('resident.add.post');

        /**
         * Define the route for the edit resident view.
         */
        Route::get('residents/{id}/edit')->uses('Management\ResidentController@edit')->name('resident.edit');

        /**
         * Define the route for the view resident view.
         */
        Route::get('residents/{id}')->uses('Management\ResidentController@view')->name('resident.view');

        /**
         * Process the request to edit a resident.
         */
        Route::post('residents/edit')->uses('Management\ResidentController@postEdit')->name('resident.edit.post');

        /**
         * Define the route for showing the employees
         */
        Route::get('employees')->uses('Management\EmployeeController@index')->name('employees');

        /**
         * Define the route for adding an employee
         */
        Route::get('employees/add')->uses('Management\EmployeeController@add')->name('employee.add');

        /**
         * Define the route to process the add resident request.
         */
        Route::post('employees/add')->uses('Management\EmployeeController@postAdd')->name('employee.add.post');

        /**
         * Define the route for the view employee iew
         */
        Route::get('employees/{id}')->uses('Management\EmployeeController@view')->name('employee.view');

        /**
         * Define the route for the edit employee view.
         */
        Route::get('employees/{id}/edit')->uses('Management\EmployeeController@edit')->name('employee.edit');

        /**
         * Process the request to edit an employee.
         */
        Route::post('employees/edit')->uses('Management\EmployeeController@postEdit')->name('employee.edit.post');

        /**
         * Define the route for the edit user view.
         */
        Route::get('user/{id}/reset-password')->uses('Management\ResetPasswordController@resetPassword')->name('management.user.reset-password');

        /**
         * Process the request to reset a user's password
         */
        Route::post('user/reset-password')->uses('Management\ResetPasswordController@postResetPassword')->name('management.user.reset-password.post');

        /**
         * Define the route for the show homes view.
         */
        Route::get('homes')->uses('Management\HomesController@index')->name('homes');

        /**
         * Define the route to add a new home.
         */
        Route::get('homes/add')->uses('Management\HomesController@add')->name('home.add');

        /**
         * Process the request to add a new home.
         */
        Route::post('homes/add')->uses('Management\HomesController@postAdd')->name('home.add.post');

        /**
         * Define the route to view a home
         */
        Route::get('homes/{id}')->uses('Management\HomesController@view')->name('home.view');

        /**
         * Define the route for the edit home view.
         */
        Route::get('homes/{id}/edit')->uses('Management\HomesController@edit')->name('home.edit');

        /**
         * Process the request to edit a home.
         */
        Route::post('homes/edit')->uses('Management\HomesController@postEdit')->name('home.edit.post');

        /**
         * Define the route to show areas.
         */
        Route::get('areas')->uses('Management\AreaController@index')->name('areas');

        /**
         * Show the add area view.
         */
        Route::get('areas/add')->uses('Management\AreaController@add')->name('areas.add');

        /**
         * Show the area
         */
        Route::get('areas/{area_id}')->uses('Management\AreaController@view')->name('areas.view')->where('area_id', '[0-9]+');

        /**
         * Define the route for the edit area view.
         */
        Route::get('areas/{id}/edit')->uses('Management\AreaController@edit')->name('areas.edit');

        /**
         * Process the request to edit an area.
         */
        Route::post('areas/edit')->uses('Management\AreaController@postEdit')->name('area.edit.post');

        /**
         * Process the request to add an area
         */
        Route::post('areas/add')->uses('Management\AreaController@postAdd')->name('area.add.post');

        /**
         * Show all of the areas
         */
        Route::get('events')->uses('Management\EventsController@index')->name('events');

        /**
         * Show the view to add an event
         */
        Route::get('events/add')->uses('Management\EventsController@add')->name('events.add');

        /**
         * Process the request to add an event
         */
        Route::post('events/add')->uses('Management\EventsController@postAdd')->name('events.add.post');

        /**
         * View an event
         */
        Route::get('events/{event}')->uses('Management\EventsController@view')->name('event');

        /**
         * Edit an event
         */
        Route::get('events/{event}/edit')->uses('Management\EventsController@edit')->name('event.edit');

        /**
         * Show the view to delete an event
         */
        Route::get('events/{event}/delete')->uses('Management\EventsController@delete')->name('event.delete')->where('event', '[0-9]+');;

        /**
         * Process the request to delete an event
         */
        Route::post('events/delete')->uses('Management\EventsController@postDelete')->name('event.delete.post');

        /**
         * Show the form for registering a resident's interest
         */
        Route::get('events/{event_id}/register-interest')->uses('Management\EventsController@registerInterestForResident')->name('management.events.register-interest');

        /**
         * Process the request for registering a resident's interest.
         */
        Route::post('events/register-interest')->uses('Management\EventsController@postRegisterInterestForResident')->name('management.events.register-interest.post');

        /**
         * Process the request for deregistering a resident's interest
         */
        Route::post('events/register-interest/deregister')->uses('Management\EventsController@postCancelInterestForResident')->name('management.events.deregister-interest.post');

        /**
         * Process the request to edit an event
         */
        Route::post('events/edit')->uses('Management\EventsController@postEdit')->name('event.edit.post');

        /**
         * Show all of the open jobs
         */
        Route::get('jobs')->uses('Management\MaintenanceJobController@index')->name('jobs');

        /**
         * Create a job on behalf of the user
         */
        Route::get('jobs/add')->uses('Management\MaintenanceJobController@add')->name('jobs.add');

        /**
         * Create a job on behalf of the user
         */
        Route::post('jobs/add')->uses('Management\MaintenanceJobController@postAdd')->name('jobs.add.post');

        /**
         * Show a specific job
         */
        Route::get('job/{job_id}')->uses('Management\MaintenanceJobController@view')->name('job')->where('job_id', '[0-9]+');

        /**
         * Show the delete confirmation view
         */
        Route::get('job/{job_id}/delete')->uses('Management\MaintenanceJobController@delete')->name('job.delete')->where('job_id', '[0-9]+');

        /**
         * Process the request to delete a job
         */
        Route::post('job/delete')->uses('Management\MaintenanceJobController@postDelete')->name('job.delete.post');

        /**
         * Add correspondence
         */
        Route::post('job/add-correspondence')->uses('Management\MaintenanceJobController@addCorrespondence')->name('job.add-correspondence');

        /**
         * Show the menu page
         */
        Route::get('menus')->uses('Management\MealMenuController@index')->name('management.menus');

        /**
         * Show the add menu page
         */
        Route::get('menus/add')->uses('Management\MealMenuController@add')->name('management.menus.add');

        /**
         * Process the request to add a menu
         */
        Route::post('menus/add')->uses('Management\MealMenuController@postAdd')->name('management.menus.add.post');

        /**
         * Add days & items to menu
         */
        Route::get('menus/{menu_id}/items')->uses('Management\MealMenuController@addItems')->name('management.menus.add-days')->where('menu_id', '[0-9]+');

        /**
         * Process the request to add items to the menu
         */
        Route::post('menus/items')->uses('Management\MealMenuController@postAddItems')->name('management.menus.add-days.post');

        /**
         * Add days & items to menu
         */
        Route::get('menus/{menu_id}')->uses('Management\MealMenuController@view')->name('management.menu.view')->where('menu_id', '[0-9]+');

        /**
         * Show the form to delete a menu
         */
        Route::get('menus/{menu_id}/delete')->uses('Management\MealMenuController@delete')->name('management.menu.delete')->where('menu_id', '[0-9]+');

        /**
         * Process the request to delete a menu
         */
        Route::post('menus/delete')->uses('Management\MealMenuController@postDelete')->name('management.menu.delete.post');

        /**
         * Show the view to edit a menu day
         */
        Route::get('menus/{menu_id}/day/{day_id}')->uses('Management\MealMenuController@editDay')->name('management.menu.edit-day')->where('menu_id', '[0-9]+')->where('day_id', '[0-9]+');

        /**
         * Show the view to edit a menu day
         */
        Route::post('menus/edit-day')->uses('Management\MealMenuController@postEditDay')->name('management.menu.edit-day.post');

        /**
         * Show all maintenance types
         */
        Route::get('maintenance-types')->uses('Management\MaintenanceTypeController@index')->name('maintenance-types');

        /**
         * Show the maintenance type with its jobs.
         */
        Route::get('maintenance-types/{type_id}')->uses('Management\MaintenanceTypeController@view')->name('maintenance-types.view')->where('type_id', '[0-9]+');

        /**
         * Add new maintenance type
         */
        Route::get('maintenance-types/add')->uses('Management\MaintenanceTypeController@add')->name('maintenance-types.add');

        /**
         * Process the request to add a maintenance type
         */
        Route::post('maintenance-types/add')->uses('Management\MaintenanceTypeController@postAdd')->name('maintenance-types.add.post');

        /**
         * Show the maintenance type with its jobs.
         */
        Route::get('maintenance-types/{type_id}/edit')->uses('Management\MaintenanceTypeController@edit')->name('maintenance-types.edit')->where('type_id', '[0-9]+');

        /**
         * Process the request to edit a maintenance type
         */
        Route::post('maintenance-types/edit')->uses('Management\MaintenanceTypeController@postEdit')->name('maintenance-types.edit.post');

        /**
         * Show all of the complaints the user has made
         */
        Route::get('complaints')->uses('Management\ComplaintsController@index')->name('management.complaints');

        /**
         * Show all of the complaints the user has made
         */
        Route::get('complaints/resolved')->uses('Management\ComplaintsController@resolved')->name('management.complaints.resolved');

        /**
         * Show the management help view
         */
        Route::get('help')->uses('Management\HelpController@help')->name('management.help');

        /**
         * Define the route for the show announcements view
         */
        Route::get('announcements')->uses('Management\AnnouncementController@index')->name('announcements');

        /**
         * Route for adding a new announcement
         */
        Route::get('announcements/add')->uses('Management\AnnouncementController@add')->name('announcements.add');

        /**
         * Process the request to add an announcement
         */
        Route::post('announcements/add')->uses('Management\AnnouncementController@postAdd')->name('announcements.add.post');

        /**
         * Show a specific announcement
         */
        Route::get('announcements/{announcement_id}')->uses('Management\AnnouncementController@view')->name('announcements.view')->where('announcement_id', '[0-9]+');

        /**
         * Hide an announcement
         */
        Route::get('announcements/{announcement_id}/hide')->uses('Management\AnnouncementController@hide')->name('announcements.hide')->where('announcement_id', '[0-9]+');

        /**
         * Reopen an announcement
         */
        Route::get('announcements/{announcement_id}/reopen')->uses('Management\AnnouncementController@reopen')->name('announcements.reopen')->where('announcement_id', '[0-9]+');

        /**
         * Delete an announcement
         */
        Route::get('announcements/{announcement_id}/delete')->uses('Management\AnnouncementController@delete')->name('announcements.delete')->where('announcement_id', '[0-9]+');

        /**
         * Process the request to delete an announcement
         */
        Route::post('announcements/delete')->uses('Management\AnnouncementController@postDelete')->name('announcements.delete.post');

        /**
         * Search functionality
         */
        Route::get('search')->uses('Management\SearchController@search')->name('management.search');

        /**
         * Show the delete confirmation view
         */
        Route::get('complaints/{complaint_id}/delete')->uses('Management\ComplaintsController@delete')->name('complaint.delete')->where('complaint_id', '[0-9]+');

        /**
         * Process the request to delete a complaint
         */
        Route::post('complaints/delete')->uses('Management\ComplaintsController@postDelete')->name('complaint.delete.post');
    });

    /**
     * In this group of routes, ONLY residents are able to access them. Other users will be redirected.
     */
    Route::middleware('auth.resident')->group(function() {

        /**
         * Define the route for the resident dashboard.
         */
        Route::get('dashboard')->uses('Resident\DashboardController@dashboard')->name('resident.dashboard');

        /**
         * Define the route for the resident's profile.
         */
        Route::get('profile')->uses('Resident\ProfileController@view')->name('user.profile');
        
        /**
         * Show the resident edit page
         */
        Route::get('profile/edit')->uses('Resident\ProfileController@edit')->name('user.edit');

        /**
         * Process the request for a resident to edit their profile
         */
        Route::post('profile/edit')->uses('Resident\ProfileController@postEdit')->name('user.edit.post');

        /**
         * Show the resident change password page
         */
        Route::get('profile/change-password')->uses('Resident\ProfileController@changePassword')->name('user.change-password');

        /**
         * Process request to change a user's password
         */
        Route::post('profile/change-password')->uses('Resident\ProfileController@postChangePassword')->name('user.change-password.post');

        /**
         * Show the resident's event page
         */
        Route::get('events')->uses('Resident\EventsController@index')->name('resident.events');

        /**
         * Show the upcoming events page
         */
        Route::get('events/upcoming')->uses('Resident\EventsController@upcoming')->name('resident.events.upcoming');

        /**
         * Show the upcoming events page
         */
        Route::get('events/past')->uses('Resident\EventsController@past')->name('resident.events.past');

        /**
         * Show the menu page
         */
        Route::get('menus')->uses('Resident\MenuController@index')->name('resident.menus');

        /**
         * Process the request to register interest in an event.
         */
        Route::post('events/register-interest')->uses('Resident\EventsController@registerInterest')->name('residents.events.register-interest.post');

        /**
         * Process the request to deregister interest in an event.
         */
        Route::post('events/deregister-interest')->uses('Resident\EventsController@deregisterInterest')->name('residents.events.deregister-interest.post');

        /**
         * Show all of the open jobs for the resident
         */
        Route::get('jobs')->uses('Resident\MaintenanceController@index')->name('resident.jobs');

        /**
         * Submit a new job
         */
        Route::get('jobs/new')->uses('Resident\MaintenanceController@add')->name('resident.jobs.add');

        /**
         * Process request to add a job
         */
        Route::post('jobs/new')->uses('Resident\MaintenanceController@postAdd')->name('resident.jobs.add.post');

        /**
         * Show a specific job
         */
        Route::get('jobs/{job_id}')->uses('Resident\MaintenanceController@view')->name('resident.jobs.view')->where('job_id', '[0-9]+');

        /**
         * Show all of the complaints the user has made
         */
        Route::get('complaints')->uses('Resident\ComplaintsController@index')->name('resident.complaints');

        /**
         * Show the add complaints view
         */
        Route::get('complaints/add')->uses('Resident\ComplaintsController@add')->name('resident.complaints.add');

        /**
         * Process request to add a complaint
         */
        Route::post('complaints/add')->uses('Resident\ComplaintsController@postAdd')->name('resident.complaints.add.post');

        /**
         * Show all of the complaints the user has made
         */
        Route::get('complaints/resolved')->uses('Resident\ComplaintsController@resolved')->name('resident.complaints.resolved');

        /**
         * Show the management help view
         */
        Route::get('help')->uses('Resident\HelpController@help')->name('resident.help');

        /**
         * Show an announcement
         */
        Route::get('announcement/{announcement_id}')->uses('Resident\AnnouncementController@show')->name('residents.announcements.view')->where('announcement_id', '[0-9]+');
    });

    /**
     * In this group of routes, ONLY maintenance staff are able to access them. Other users will be redirected.
     */
    Route::middleware('auth.maintenance')->prefix('maintenance')->group(function() {

        /**
         * Define the route for the resident dashboard.
         */
        Route::get('dashboard')->uses('Maintenance\DashboardController@dashboard')->name('maintenance.dashboard');

        /**
         * Show all of the open jobs
         */
        Route::get('requests')->uses('Maintenance\JobController@index')->name('maintenance.jobs');

        /**
         * Show a specific job
         */
        Route::get('requests/{job_id}')->uses('Maintenance\JobController@view')->name('maintenance.job')->where('job_id', '[0-9]+');;

        /**
         * Add correspondence
         */
        Route::post('requests/add-correspondence')->uses('Maintenance\JobController@addCorrespondence')->name('maintenance.job.add-correspondence');
        Route::post('requests/add-correspondence')->uses('Maintenance\JobController@addCorrespondence')->name('maintenance.job.add-correspondence');

        /**
         * Create a request on behalf of the user
         */
        Route::get('requests/add')->uses('Maintenance\JobController@add')->name('maintenance.jobs.add');

        /**
         * Process the request to add a job request on behalf of a user
         */
        Route::post('requests/add')->uses('Maintenance\JobController@postAdd')->name('maintenance.jobs.add.post');

        /**
         * Show the management help view
         */
        Route::get('support')->uses('Maintenance\HelpController@help')->name('maintenance.help');

        /**
         * Show the maintenance change password page
         */
        Route::get('change-password')->uses('Maintenance\ProfileController@changePassword')->name('maintenance.change-password');

        /**
         * Process request to change a user's password
         */
        Route::post('change-password')->uses('Maintenance\ProfileController@postChangePassword')->name('maintenance.change-password.post');

    });

    /**
     * In this group of routes, ADMINs and MAINTENANCE users are allowed to access them.
     */
    Route::middleware('auth.update.jobs')->group(function () {

        /**
         * Mark job as certain statuses
         */
        Route::get('job/{job_id}/update-status/in-progress')->uses('Management\MaintenanceJobController@markInProgress')->name('job.update.in-progress');
        Route::get('job/{job_id}/update-status/completed')->uses('Management\MaintenanceJobController@completed')->name('job.update.completed');
        Route::get('job/{job_id}/update-status/submitted')->uses('Management\MaintenanceJobController@reopen')->name('job.update.reopen');

        /**
         * Return residents for select2
         */
        Route::get('api/residents')->uses('Management\ResidentController@lookup')->name('api.residents');

        /**
         * Create a job on behalf of the user
         */
        Route::post('jobs/add')->uses('Management\MaintenanceJobController@postAdd')->name('jobs.add.post');
    });

    /**
     * In this group of routes, both ADMINS and RESIDENTs are allowed to access them.
     */
    Route::middleware('auth.update.complaints')->group(function () {

        /**
         * View the given complaint.
         */
        Route::get('complaints/{complaint_id}')->uses('Common\ManageComplaintController@view')->name('common.complaints.view');

        /**
         * Resolve the complaint.
         */
        Route::get('complaints/{complaint_id}/resolve')->uses('Common\ManageComplaintController@resolve')->name('common.complaints.resolve');

        /**
         * Resolve the complaint.
         */
        Route::get('complaints/{complaint_id}/reopen')->uses('Common\ManageComplaintController@reopen')->name('common.complaints.reopen');

        /**
         * Add correspondence to the complaint.
         */
        Route::post('complaints/add-correspondence')->uses('Common\ManageComplaintController@addCorrespondence')->name('common.complaints.add-correspondence');

        /**
         * Add a comment to a announcement
         */
        Route::post('announcement/comments')->uses('Common\AnnouncementController@comment')->name('announcements.add-comment.post');
    });

    /**
     * Below are the routes that any authenticated user can access.
     */

    /**
     * Show the closed jobs.
     */
    Route::get('jobs/closed')->uses('Common\MaintenanceJobController@closedJobs')->name('jobs.closed');

    /**
     * Define the route for logging out.
     */
    Route::get('logout')->uses('Auth\LoginController@logout')->name('logout');
});

// Route::get('test', function() {
//
//    $content = file_get_contents('https://raw.githubusercontent.com/FortAwesome/Font-Awesome/master/advanced-options/metadata/icons.json');
//    $json = json_decode($content);
//    $icons = "";
//
//    $options = "";
//
//    foreach ($json as $icon => $value) {
//
//        foreach ($value->styles as $style) {
//            $style = 'fa' . substr($style, 0 ,1);
//            $class = ' fa-'. $icon;
//
//            $icons .= '["name" => "' . $value->label . '", "class" => "' . $style . $class . '"],';
//        }
//    }
//
//    echo nl2br($icons);
//});