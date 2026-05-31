<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;

class ChannelController extends Controller
{
    public function index()
    {
        $channels = Channel::latest()->get();
        return view('channels.index', compact('channels'));
    }

    public function show(Channel $channel)
    {
        return view('channels.show', compact('channel'));
    }
}
