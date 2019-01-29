<?php

namespace App\Http\Controllers\Management;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    /**
     * Show the areas view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $areas = Area::orderBy('name')->paginate();

        return view('auth.management.areas.index', compact('areas'));
    }

    /**
     * Show the given area.
     *
     * @param $area_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($area_id)
    {
        $area = Area::findOrFail($area_id);

        $homes = $area->homes()->paginate();

        return view('auth.management.areas.view', compact('area', 'homes'));
    }

    /**
     * Show the add area view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('auth.management.areas.add');
    }

    /**
     * Process the request to add an area.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(Request $request)
    {
        $messages = [
            'name.required' => 'Please enter an area name'
        ];

        $this->validate($request, [
            'name'  => 'required'
        ], $messages);

        Area::create([
            'name'  => $request->input('name')
        ]);

        return redirect()->route('areas')->with('success', 'Successfully added area');
    }

    /**
     * Process the request to edit an area.
     *
     * @param $area_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @internal param $name
     */
    public function edit($area_id)
    {
        $area = Area::findOrFail($area_id);

        return view('auth.management.areas.edit', compact('area'));
    }

    /**
     * Process the request to edit an area.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        $messages = [
            'name.required' => 'Please enter an area name'
        ];

        $area = Area::findOrFail($request->input('area_id'));

        $validated = $this->validate($request, [
            'name'      => 'required',
            'area_id'   => 'required'
        ], $messages);

        $area->update($validated);

        return redirect()->route('areas')->with('success', 'Successfully updated area');
    }
}
