@extends('layouts.app')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h2 class="mb-1">Upcoming Matches</h2>
        <p class="text-muted">Explore the latest match entries and preview external sources.</p>
    </div>
    <a href="/" class="btn btn-outline-secondary">Back to Dashboard</a>
</div>

<div class="row gy-4">
    @foreach($matches as $match)
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title mb-2">{{ $match->title }}</h5>
                    <p class="text-muted mb-3">Starts at: {{ $match->starts_at?->format('M d, Y H:i') ?? 'N/A' }}</p>
                    <a href="/matches/{{ $match->id }}" class="stretched-link">View match details</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
