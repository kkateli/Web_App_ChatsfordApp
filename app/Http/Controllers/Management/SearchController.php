<?php

namespace App\Http\Controllers\Management;

use App\Models\Area;
use App\Models\Home;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Show search results.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            "q"     => "required",
            "type"  => "nullable|in:resident,employee,home,area"
        ]);

        $query = $request->input("q");

        if ($request->filled("type")) {

            if ($request->input("type") === "resident") {
                // resident search
                $users = User::residents()->where(DB::raw("CONCAT(first_name, ' ', last_name)"), "LIKE", "%" . $query . "%")->get();
                $homes = collect();
                $areas = collect();
            }

            if ($request->input("type") === "employee") {
                // employee search
                $users = User::employees()->where(DB::raw("CONCAT(first_name, ' ',last_name)"), "LIKE", "%" . $query . "%")->get();
                $homes = collect();
                $areas = collect();
            }

            if ($request->input("type") === "home") {
                // home search
                $homes = Home::where('name', "LIKE", "%" . $query . "%")->orWhere('number', "LIKE", "%" . $query . "%")->get();
                $users = collect();
                $areas = collect();
            }

            if ($request->input("type") === "area") {
                $areas = Area::where("name", "LIKE", "%" . $query . "%")->get();
                $homes = collect();
                $users = collect();
            }

        } else {
            // global search
            $users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), "LIKE", "%" . $query . "%")->get();

            $homes = Home::where('name', "LIKE", "%" . $query . "%")->orWhere('number', "LIKE", "%" . $query . "%")->get();

            $areas = Area::where("name", "LIKE", "%" . $query . "%")->get();
        }

        return view("auth.management.search.results", compact("users", "homes", "areas", "query"));
    }
}
