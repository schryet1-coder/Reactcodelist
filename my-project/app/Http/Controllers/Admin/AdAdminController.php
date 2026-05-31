<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;

class AdAdminController extends Controller
{
    public function index()
    {
        $ads = Ad::all();
        return view('admin.ads.index', compact('ads'));
    }
    
    public function create()
    {
        return view('admin.ads.create');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'position' => 'required|string',
            'content' => 'required|string',
            'active' => 'sometimes|boolean',
        ]);

        Ad::create($data);
        return redirect('/admin/ads')->with('message', 'Ad created');
    }

    public function edit(Ad $ad)
    {
        return view('admin.ads.edit', compact('ad'));
    }

    public function update(\Illuminate\Http\Request $request, Ad $ad)
    {
        $data = $request->validate([
            'position' => 'required|string',
            'content' => 'required|string',
            'active' => 'sometimes|boolean',
        ]);

        $ad->update($data);
        return redirect('/admin/ads')->with('message', 'Ad updated');
    }

    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect('/admin/ads')->with('message', 'Ad deleted');
    }
}
