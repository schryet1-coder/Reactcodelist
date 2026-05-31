<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;

class SubscriptionAdminController extends Controller
{
    public function index()
    {
        $plans = Subscription::all();
        return view('admin.subscriptions.index', compact('plans'));
    }
    
    public function create()
    {
        return view('admin.subscriptions.create');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'period_days' => 'required|integer',
            'features' => 'nullable|string',
            'active' => 'sometimes|boolean',
        ]);

        $data['features'] = $data['features'] ? json_decode($data['features'], true) : null;
        Subscription::create($data);
        return redirect('/admin/subscriptions')->with('message', 'Subscription created');
    }

    public function edit(Subscription $subscription)
    {
        return view('admin.subscriptions.edit', compact('subscription'));
    }

    public function update(\Illuminate\Http\Request $request, Subscription $subscription)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'period_days' => 'required|integer',
            'features' => 'nullable|string',
            'active' => 'sometimes|boolean',
        ]);

        $data['features'] = $data['features'] ? json_decode($data['features'], true) : null;
        $subscription->update($data);
        return redirect('/admin/subscriptions')->with('message', 'Subscription updated');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect('/admin/subscriptions')->with('message', 'Subscription deleted');
    }
}
