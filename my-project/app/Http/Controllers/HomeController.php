<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Channel;
use App\Models\MatchModel;
use App\Models\Reel;
use App\Models\Subscription;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'channels' => Channel::count(),
            'matches' => MatchModel::count(),
            'reels' => Reel::count(),
            'ads' => Ad::count(),
            'plans' => Subscription::where('active', true)->count(),
        ];

        return view('home', compact('stats'));
    }

    public function fetchByExtremeCode(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        $code = $request->input('code');

        // Dispatch job to fetch channels (runs sync if queue worker not configured)
        \App\Jobs\FetchChannelsJob::dispatch($code)->onQueue('default');

        return redirect()->back()->with('message', 'Channel fetch dispatched.');
    }

    public function fetchMatchesFromSite(Request $request)
    {
        $request->validate(['site_url' => 'required|url']);
        $site = $request->input('site_url');

        // Placeholder: actual scraping/parsing would go here
        MatchModel::create([
            'title' => "Example Match from {$site}",
            'external_url' => $site,
        ]);

        return redirect()->back()->with('message', 'Matches scraped (stub) and saved.');
    }
}
