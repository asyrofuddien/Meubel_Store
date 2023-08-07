<?php

namespace App\Http\Controllers;

use App\Category;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSettingController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store()
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('pages.dashboard-settings',[
            'user' => $user,
            'categories' => $categories,
        ]);
    }

    public function account()
    {
        $provinces = Province::all();
        $regencies = Regency::all();
        $user = Auth::user();
        return view('pages.dashboard-account',[
            'user' => $user,
            'prov' => $provinces,
            'kota' => $regencies
        ]);
    }

    public function update(Request $request, $redirect)
    {
        $data = $request->all();
        $item = Auth::user();

        $item->update($data);

        return redirect()->route($redirect);
    }
}
