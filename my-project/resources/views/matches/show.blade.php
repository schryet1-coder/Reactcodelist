@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h2 class="mb-1">{{ $match->title }}</h2>
                <p class="text-muted mb-0">External source: <a href="{{ $match->external_url }}" target="_blank">{{ $match->external_url }}</a></p>
            </div>
            <a href="/matches" class="btn btn-sm btn-outline-secondary">Back</a>
        </div>
        <dl class="row mb-0">
            <dt class="col-sm-4">Starts at</dt>
            <dd class="col-sm-8">{{ $match->starts_at?->format('M d, Y H:i') ?? 'Not set' }}</dd>
            <dt class="col-sm-4">Metadata</dt>
            <dd class="col-sm-8"><pre class="bg-light p-3 rounded">{{ json_encode($match->meta, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre></dd>
        </dl>
    </div>
</div>
@endsection
