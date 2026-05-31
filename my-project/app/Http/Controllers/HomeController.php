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

        // Dispatch job to fetch channels from the Extreme API.
        // When queue worker is not configured, it will run immediately.
        \App\Jobs\FetchChannelsJob::dispatchSync($code);

        return redirect()->back()->with('message', 'Channel fetch completed. Check the Channels page for updated results.');
    }

    public function fetchMatchesFromSite(Request $request)
    {
        $request->validate(['site_url' => 'required|url']);
        $site = $request->input('site_url');

        $title = null;
        try {
            $html = file_get_contents($site);
            if ($html) {
                if (preg_match('/<meta\s+property=["\']og:title["\']\s+content=["\']([^"\']+)["\']/i', $html, $matches)) {
                    $title = trim($matches[1]);
                } elseif (preg_match('/<title>(.*?)<\/title>/is', $html, $matches)) {
                    $title = trim($matches[1]);
                }
            }
        } catch (\Throwable $e) {
            logger()->warning('Failed to scrape match source: ' . $e->getMessage());
        }

        MatchModel::create([
            'title' => $title ?: "Imported match from {$site}",
            'external_url' => $site,
            'meta' => ['source' => $site],
        ]);

        return redirect()->back()->with('message', 'Match source imported successfully.');
    }
}
