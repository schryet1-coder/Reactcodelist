@extends('layouts.app')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h2 class="mb-1">Channels Marketplace</h2>
        <p class="text-muted">Browse available channels and review metadata for every feed.</p>
    </div>
    <a href="/" class="btn btn-outline-secondary">Back to Dashboard</a>
</div>

<div class="row gy-4">
    @foreach($channels as $channel)
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title mb-1">{{ $channel->name }}</h5>
                    <p class="text-muted mb-3">Identifier: <strong>{{ $channel->identifier }}</strong></p>
                    <p class="text-truncate">{{ json_encode($channel->meta) }}</p>
                    <a href="/channels/{{ $channel->id }}" class="stretched-link"></a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
