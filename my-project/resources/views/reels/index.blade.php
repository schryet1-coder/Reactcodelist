@extends('layouts.app')

@section('content')
<h3>Reels</h3>
@foreach($reels as $r)
    <div class="mb-3">
        <h5>{{ $r->title }}</h5>
        <video width="320" height="180" controls src="{{ asset('storage/' . $r->path) }}"></video>
    </div>
@endforeach

<h4>Upload Reel</h4>
<form method="post" enctype="multipart/form-data" action="/reels">
    @csrf
    <input name="title" class="form-control mb-2" placeholder="Title">
    <input type="file" name="video" class="form-control mb-2">
    <button class="btn btn-primary">Upload</button>
</form>

@endsection
