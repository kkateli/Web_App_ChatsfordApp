<?php

namespace App\Http\Controllers\Management;

use App\Models\MaintenanceType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class MaintenanceTypeController extends Controller
{
    /**
     * Display all of the maintenance types.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $types = MaintenanceType::orderBy('name')->paginate();

        return view('auth.management.maintenance_types.index', compact('types'));
    }

    /**
     * Show the given maintenance type.
     *
     * @param $maintenance_type_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($maintenance_type_id)
    {
        $maintenanceType = MaintenanceType::findOrFail($maintenance_type_id);

        $jobs = $maintenanceType->maintenance_jobs()->paginate();

        return view('auth.management.maintenance_types.view', compact('maintenanceType', 'jobs'));
    }

    /**
     * Show the add maintenance type view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $icons = config('icons');

        return view('auth.management.maintenance_types.add', compact('icons'));
    }

    /**
     * Process the request to add a maintenance type.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(Request $request)
    {
        $messages = [
            'name.required' => 'Please enter a name',
        ];

        $this->validate($request, [
            'name'      => 'required|unique:maintenance_types',
            'icon_type' => 'nullable'
        ], $messages);

        MaintenanceType::create([
            'name'      => $request->input('name'),
            'icon_type' => $request->input('icon_type')
        ]);

        return redirect()->route('maintenance-types')->with('success', 'Successfully added maintenance type');
    }

    /**
     * Show the form to edit a maintenance type.
     *
     * @param $maintenance_type_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($maintenance_type_id)
    {
        $maintenanceType = MaintenanceType::findOrFail($maintenance_type_id);

        $icons           = config('icons');

        return view('auth.management.maintenance_types.edit', compact('maintenanceType', 'icons'));
    }

    /**
     * Process the request to edit a maintenance type.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        $maintenanceType = MaintenanceType::findOrFail($request->input('type_id'));

        $validated = $this->validate($request, [
            'type_id'                    => 'required',
            'name' => [
                'required',
                Rule::unique('maintenance_types')->ignore($maintenanceType->id)
            ],
            'icon_type'             => 'nullable'
        ]);

        $maintenanceType->update($validated);

        return redirect()->route('maintenance-types.view', $maintenanceType)->with('success', 'Successfully edited maintenance type');
    }
}
