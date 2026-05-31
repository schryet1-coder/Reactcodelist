@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2 class="mb-2">Advertising Spaces</h2>
        <p class="text-muted">Manage ad placements and preview active ads across the platform.</p>
    </div>
    <div class="col-md-4 text-md-end">
        <a href="#new-ad" class="btn btn-primary">Add New Ad</a>
    </div>
</div>

<div class="row gy-3">
    @foreach($ads as $a)
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title mb-0">{{ $a->position }}</h5>
                        <span class="badge bg-{{ $a->active ? 'success' : 'secondary' }}">{{ $a->active ? 'Active' : 'Inactive' }}</span>
                    </div>
                    <div class="mb-3 text-muted">{!! $a->content !!}</div>
                    <small class="text-muted">Updated {{ $a->updated_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div id="new-ad" class="card shadow-sm border-0 mt-5">
    <div class="card-body">
        <h4 class="card-title mb-3">Create New Ad</h4>
        <form method="post" action="/ads">
            @csrf
            <div class="mb-3">
                <label class="form-label">Position</label>
                <input name="position" class="form-control" placeholder="e.g. homepage-top" required>
            </div>
            <div class="mb-3">
                <label class="form-label">HTML Content</label>
                <textarea name="content" class="form-control" rows="4" placeholder="Ad content or embed code" required></textarea>
            </div>
            <button class="btn btn-primary">Save Ad</button>
        </form>
    </div>
</div>
@endsection
