@extends('layouts.app')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h2 class="mb-1">Reels Gallery</h2>
        <p class="text-muted">Upload premium clips and showcase your best short videos.</p>
    </div>
    <a href="/subscriptions" class="btn btn-outline-secondary">Upgrade Account</a>
</div>

<div class="row gy-4">
    @foreach($reels as $reel)
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">{{ $reel->title }}</h5>
                    <video class="w-100 rounded" controls src="{{ asset('storage/' . $reel->path) }}"></video>
                    <p class="text-muted mt-3 mb-0">Uploaded {{ $reel->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="card shadow-sm border-0 mt-5">
    <div class="card-body">
        <h4 class="card-title mb-3">Upload a new reel</h4>
        <form method="post" enctype="multipart/form-data" action="/reels">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input name="title" class="form-control" placeholder="Reel title" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Video file</label>
                <input type="file" name="video" class="form-control" accept="video/mp4,video/webm,video/ogg" required>
            </div>
            <button class="btn btn-primary">Upload Reel</button>
        </form>
    </div>
</div>
@endsection
