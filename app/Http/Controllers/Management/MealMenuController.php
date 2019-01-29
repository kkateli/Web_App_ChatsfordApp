<?php

namespace App\Http\Controllers\Management;

use App\Models\Menu;
use App\Models\MenuDay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MealMenuController extends Controller
{
    /**
     * Show the menus.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $menus = Menu::orderByDesc('start_date')->paginate();

        return view('auth.management.menus.index', compact('menus'));
    }

    /**
     * View the incoming menu.
     *
     * @param $menu_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($menu_id)
    {
        $menu = Menu::with('days')->findOrFail($menu_id);

        if ($menu->days->count() === 0) {
            return redirect()->route('management.menus.add-days', $menu);
        }

        return view('auth.management.menus.view', compact('menu'));
    }

    /**
     * Show the view to add a menu.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('auth.management.menus.add');
    }

    /**
     * Process the request to add a menu.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(Request $request)
    {
        $messages = [
            'start_date_submit.required' => 'Please select a start date',
            'end_date_submit.required'   => 'Please select an end date',
            'start_date_submit.before'   => 'The start date must be before the end date',
            'end_date_submit.after'      => 'The end date must be after the start date',
        ];

        $this->validate($request, [
            'start_date_submit' => 'required|before:end_date_submit|date_format:Y-m-d',
            'end_date_submit'   => 'required|after:start_date_submit|date_format:Y-m-d',
        ], $messages);

        $startDate  = Carbon::parse($request->input('start_date'))->toDateString();
        $endDate    = Carbon::parse($request->input('end_date'))->toDateString();

        // check if the submitted menu is overlapping any other menus in the system
        $overlappingCheck = Menu::where(function($query) use ($startDate, $endDate) {
            return $query->where(function($query) use ($startDate, $endDate) {
                return $query->where('start_date', '<=', $startDate)->where('end_date', '>=', $startDate);
            });
        })->count();

        if ($overlappingCheck > 0) {
            return redirect()->route('management.menus.add')->with('error', 'There is a menu in the system that overlaps with the days you have specified');
        }

        $menu = Menu::create([
            'start_date'    => $startDate,
            'end_date'      => $endDate
        ]);

        return redirect()->route('management.menus.add-days', $menu);
    }

    /**
     * Show the add items to menu view.
     *
     * @param $menu_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addItems($menu_id)
    {
        $menu = Menu::findOrFail($menu_id);

        return view('auth.management.menus.add-items', compact('menu'));
    }

    /**
     * Process the request to add the items to the menu.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddItems(Request $request)
    {
        $this->validate($request, [
            'dates'     => 'required',
            'menu_id'   => 'required'
        ]);

        $menu = Menu::findOrFail($request->input('menu_id'));

        foreach ($request->input('dates') as $date => $arr) {
            $menu->days()->updateOrCreate([
                'menu_id'   => $menu->id,
                'date'      => $date
            ], [
                'lunch'     => $arr['lunch'],
                'dinner'    => $arr['dinner']
            ]);
        }

        return redirect()->route('management.menus')->with('success', 'Successfully added menu');
    }

    /**
     * Show the edit menu day view.
     *
     * @param $day_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editDay($menu_id, $day_id)
    {
        $menuDay = MenuDay::findOrFail($day_id);

        return view('auth.management.menus.edit-day', compact('menuDay'));
    }

    /**
     * Process the request to edit the menu day.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditDay(Request $request)
    {
        $this->validate($request, [
            'lunch'     => 'nullable',
            'dinner'    => 'nullable',
            'day_id'    => 'required'
        ]);

        $menuDay = MenuDay::findOrFail($request->input('day_id'));

        $menuDay->update([
            'lunch'     => $request->input('lunch'),
            'dinner'    => $request->input('dinner')
        ]);

        return redirect()->route('management.menu.view', $menuDay->menu)->with('success', 'Successfully updated menu day');
    }

    /**
     * Show the delete confirmation view.
     *
     * @param $menu_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($menu_id)
    {
        $menu = Menu::findOrFail($menu_id);

        return view('auth.management.menus.delete', compact('menu'));
    }

    /**
     * Process the request to delete a menu.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete(Request $request)
    {
        $this->validate($request, [
            'menu_id'   => 'required'
        ]);

        $menu = Menu::findOrFail($request->input('menu_id'));

        $menu->delete();

        return redirect()->route('management.menus')->with('success', 'Successfully deleted menu');
    }
}
