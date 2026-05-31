<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::all();
        return view('ads.index', compact('ads'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'position' => 'required|string',
            'content' => 'required|string',
        ]);

        Ad::create($data);
        return redirect()->back()->with('message', 'Ad saved.');
    }
}
