@extends('layouts.app')

@section('content')
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-start gap-3 flex-column flex-md-row">
        <div>
            <h2 class="mb-1">Upcoming Matches</h2>
            <p class="text-muted">Explore the latest match entries and preview external sources.</p>
        </div>
        <a href="/" class="btn btn-outline-secondary">Back to Dashboard</a>
    </div>
    <form method="get" class="row g-2 mt-3">
        <div class="col-md-8">
            <input type="search" name="q" value="{{ $query ?? '' }}" class="form-control" placeholder="Search matches by title or source URL">
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary w-100">Search Matches</button>
        </div>
    </form>
</div>

@if(isset($query) && $query !== '')
    <div class="alert alert-info mb-4">Showing results for "{{ $query }}" ({{ $matches->count() }} matches found).</div>
@endif

<div class="row gy-4">
    @forelse($matches as $match)
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title mb-2">{{ $match->title }}</h5>
                    <p class="text-muted mb-3">Starts at: {{ $match->starts_at?->format('M d, Y H:i') ?? 'N/A' }}</p>
                    <a href="/matches/{{ $match->id }}" class="stretched-link">View match details</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-warning">No matches found. Try another search term or import a new source.</div>
        </div>
    @endforelse
</div>
@endsection
