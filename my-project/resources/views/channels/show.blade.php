@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h2 class="mb-1">{{ $channel->name }}</h2>
                <p class="text-muted">Channel identifier: <strong>{{ $channel->identifier }}</strong></p>
            </div>
            <a href="/channels" class="btn btn-sm btn-outline-secondary">Back</a>
        </div>
        <div class="mb-3">
            <h5>Metadata</h5>
            <pre class="bg-light p-3 rounded">{{ json_encode($channel->meta, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
        </div>
    </div>
</div>
@endsection
