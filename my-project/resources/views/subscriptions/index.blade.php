@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2 class="mb-1">Subscription Plans</h2>
    <p class="text-muted">اختر الباقة المناسبة لتوسيع قدراتك والوصول إلى المحتوى الحصري.</p>
    @if(auth()->check() && $current)
        <div class="alert alert-success">Current plan: <strong>{{ $current->subscription->name }}</strong> until {{ $current->ends_at->format('M d, Y') }}</div>
    @elseif(auth()->check())
        <div class="alert alert-info">You do not have an active subscription yet. Choose a plan to unlock premium features.</div>
    @else
        <div class="alert alert-secondary">Please login or register to start your premium membership.</div>
    @endif
</div>

<div class="row gy-4">
    @foreach($plans as $p)
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h4 class="card-title mb-1">{{ $p->name }}</h4>
                            <small class="text-muted">{{ $p->period_days }} days access</small>
                        </div>
                        <span class="badge bg-{{ $p->active ? 'success' : 'secondary' }}">{{ $p->active ? 'Active' : 'Inactive' }}</span>
                    </div>
                    <h3 class="fw-semibold mb-3">${{ number_format($p->price, 2) }}</h3>
                    @if($p->features)
                        <ul class="list-unstyled mb-3 text-sm">
                            @foreach($p->features as $feature)
                                <li class="mb-2">• {{ $feature }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form method="post" action="{{ url('/subscriptions/checkout/'.$p->id) }}">
                        @csrf
                        @if(auth()->check())
                            <button class="btn btn-primary w-100">Subscribe Now</button>
                        @else
                            <a href="{{ url('/login') }}" class="btn btn-outline-primary w-100">Login to subscribe</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
