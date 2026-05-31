<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reel;

class ReelController extends Controller
{
    public function index()
    {
        $reels = Reel::latest()->get();
        return view('reels.index', compact('reels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'video' => 'required|file|mimes:mp4,webm,ogg|max:10240',
        ]);

        $path = $request->file('video')->store('reels', 'public');

        $reel = Reel::create([
            'title' => $data['title'],
            'path' => $path,
            'user_id' => auth()->id() ?? null,
        ]);

        return redirect()->back()->with('message', 'Reel uploaded.');
    }

    public function show(Reel $reel)
    {
        return view('reels.show', compact('reel'));
    }
}
