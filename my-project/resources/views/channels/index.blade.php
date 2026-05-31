@extends('layouts.app')

@section('content')
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-start gap-3 flex-column flex-md-row">
        <div>
            <h2 class="mb-1">Channels Marketplace</h2>
            <p class="text-muted">Browse available channels and review metadata for every feed.</p>
        </div>
        <a href="/" class="btn btn-outline-secondary">Back to Dashboard</a>
    </div>
    <form method="get" class="row g-2 mt-3">
        <div class="col-md-8">
            <input type="search" name="q" value="{{ $query ?? '' }}" class="form-control" placeholder="Search channels by name or identifier">
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary w-100">Search Channels</button>
        </div>
    </form>
</div>

@if(isset($query) && $query !== '')
    <div class="alert alert-info mb-4">Showing results for "{{ $query }}" ({{ $channels->count() }} channels found).</div>
@endif

<div class="row gy-4">
    @forelse($channels as $channel)
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title mb-1">{{ $channel->name }}</h5>
                    <p class="text-muted mb-2">Identifier: <strong>{{ $channel->identifier }}</strong></p>
                    <p class="text-truncate mb-3">{{ json_encode($channel->meta) }}</p>
                    <a href="/channels/{{ $channel->id }}" class="stretched-link"></a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-warning">No channels found. Try a different search term or import channels from the dashboard.</div>
        </div>
    @endforelse
</div>
@endsection
