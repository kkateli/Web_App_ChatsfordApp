<?php

namespace App\Http\Controllers\Resident;

use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Show the list of homes in the system.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $menu = Menu::whereDate('start_date', '<=', Carbon::now()->toDateString())
                    ->whereDate('end_date', '>=', Carbon::now()->toDateString())
                    ->with('days')->first();

        return view('auth.residents.menus.index', compact('menu'));
    }

}
