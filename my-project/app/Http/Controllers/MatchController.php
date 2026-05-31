<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchModel;

class MatchController extends Controller
{
    public function index()
    {
        $matches = MatchModel::latest()->get();
        return view('matches.index', compact('matches'));
    }

    public function show(MatchModel $match)
    {
        return view('matches.show', compact('match'));
    }
}
