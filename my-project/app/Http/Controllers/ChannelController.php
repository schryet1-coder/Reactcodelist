<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;

class ChannelController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->input('q', ''));

        $channels = Channel::query()
            ->when($query, function ($builder) use ($query) {
                $builder->where(function ($sub) use ($query) {
                    $sub->where('name', 'like', "%{$query}%")
                        ->orWhere('identifier', 'like', "%{$query}%");
                });
            })
            ->latest()
            ->get();

        return view('channels.index', compact('channels', 'query'));
    }

    public function show(Channel $channel)
    {
        return view('channels.show', compact('channel'));
    }
}
