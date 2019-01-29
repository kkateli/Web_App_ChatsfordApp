<?php

namespace App\Http\Controllers\Management;

use App\Models\Area;
use App\Models\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomesController extends Controller
{
    /**
     * Show the list of homes in the system.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        $homes = Home::with('residents')
//                    ->join('areas', 'areas.id', '=', 'homes.area_id')
//                    ->orderBy('areas.name')
//                    ->paginate();

        $homes = Home::with('area', 'residents')->orderBy('name')->paginate();

        return view('auth.management.homes.index', compact('homes'));
    }

    /**
     * Show the given home.
     *
     * @param $home_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($home_id)
    {
        $home = Home::findOrFail($home_id);

        $jobs = $home->maintenance_jobs()->paginate();

        return view('auth.management.homes.view', compact('home','jobs'));
    }

    /**
     * Show the view to add a new home.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $areas = Area::orderBy('name')->get();

        return view('auth.management.homes.add', compact('areas'));
    }

    /**
     * Show the view to edit a given home.
     *
     * @param $home_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @internal param $name
     */
    public function edit($home_id)
    {
        $areas = Area::get();

        $home = Home::findOrFail($home_id);

        return view('auth.management.homes.edit', compact('home', 'areas'));
    }

    /**
     * Process the request to add a new home.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(Request $request)
    {
        $messages = [
            'name.required'     => 'Please enter a house name',
            'number.required'   => 'Please enter a house number',
            'area_id.required'  => 'Please select an area',
            'number.numeric'    => 'Please enter a numeric value'
        ];

        // validate the request
        $this->validate($request, [
            'name'      => 'required',
            'number'    => 'required|numeric',
            'area_id'   => 'required'
        ], $messages);

        // check for duplicate homes
        if(Home::where('name', $request->input('name'))->where('number', $request->input('number'))->exists()) {
            return redirect()->route('home.add')->with('error', $request->input('number') . ', ' . $request->input('name') . ' is already present in the system');
        }

        $home = Home::create([
            'name'      => $request->input('name'),
            'number'    => $request->input('number')
        ]);

        // if the user has selected an area, we need to associate the area with them
        if ($request->filled('area_id')) {
            $home->area()->associate(
                $request->input('area_id')
            )->save();
        }

        return redirect()->route('homes')->with('success', 'Successfully added home');
    }

    /**
     * Process request to edit a home.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        // define the validation messages should the request be invalid
        $messages = [
            'name.required'     => 'Please enter a house name',
            'number.required'   => 'Please enter a house number'
        ];

        // get the user
        $home = Home::findOrFail($request->input('home_id'));

        // validate the request
        $validated = $this->validate($request, [
            'name'      => 'required',
            'number'    => 'required',
            'area_id'   => 'required'
        ], $messages);

        if ($request->filled('area_id')) {
            $home->area()->associate(
                $request->input('area_id')
            )->save();
        }

        // update the user
        $home->update($validated);

        // redirect them back to the profile page
        return redirect()->route('homes')->with('success', 'Successfully updated home');
    }
}
