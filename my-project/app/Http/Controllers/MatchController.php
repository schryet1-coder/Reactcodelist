<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchModel;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->input('q', ''));

        $matches = MatchModel::query()
            ->when($query, fn($builder) => $builder->where(function ($sub) use ($query) {
                $sub->where('title', 'like', "%{$query}%")
                    ->orWhere('external_url', 'like', "%{$query}%");
            }))
            ->latest()
            ->get();

        return view('matches.index', compact('matches', 'query'));
    }

    public function show(MatchModel $match)
    {
        return view('matches.show', compact('match'));
    }
}
