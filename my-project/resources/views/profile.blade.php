@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div>
                        <h3 class="mb-1">Hello, {{ $user->name }}</h3>
                        <p class="text-muted mb-0">Your account overview and subscription status.</p>
                    </div>
                    <span class="badge bg-{{ $user->hasActiveSubscription() ? 'success' : 'secondary' }} align-self-center">
                        {{ $user->hasActiveSubscription() ? 'Premium Member' : 'Free User' }}
                    </span>
                </div>

                <dl class="row">
                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $user->email }}</dd>

                    <dt class="col-sm-4">Joined</dt>
                    <dd class="col-sm-8">{{ $user->created_at->format('M d, Y') }}</dd>

                    <dt class="col-sm-4">Active subscription</dt>
                    <dd class="col-sm-8">
                        @if($user->hasActiveSubscription())
                            {{ $user->activeSubscription()->subscription->name }} until {{ $user->activeSubscription()->ends_at->format('M d, Y') }}
                            <span class="d-block text-muted">{{ $user->activeSubscription()->remainingDays() }} day{{ $user->activeSubscription()->remainingDays() === 1 ? '' : 's' }} remaining</span>
                        @else
                            No active plan. <a href="{{ url('/subscriptions') }}">Choose a plan</a>.
                        @endif
                    </dd>
                </dl>

                <div class="mt-4">
                    <a href="{{ url('/subscriptions') }}" class="btn btn-outline-primary">View plans</a>
                    <a href="{{ url('/reels') }}" class="btn btn-primary ms-2">Explore reels</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h5 class="card-title">Quick Access</h5>
                <ul class="list-unstyled mb-0">
                    <li><a href="{{ url('/channels') }}">Channels catalog</a></li>
                    <li><a href="{{ url('/matches') }}">Upcoming matches</a></li>
                    <li><a href="{{ url('/ads') }}">Advertising spaces</a></li>
                    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
