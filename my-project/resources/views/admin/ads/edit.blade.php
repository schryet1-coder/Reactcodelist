@extends('layouts.app')

@section('content')
<h3>Edit Ad</h3>
<form method="post" action="/admin/ads/{{ $ad->id }}">
    @csrf
    <div class="mb-2"><input name="position" value="{{ $ad->position }}" class="form-control"></div>
    <div class="mb-2"><textarea name="content" class="form-control">{{ $ad->content }}</textarea></div>
    <button class="btn btn-primary">Save</button>
 </form>
@endsection
