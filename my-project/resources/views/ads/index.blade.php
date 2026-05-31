@extends('layouts.app')

@section('content')
<h3>Ads</h3>
@foreach($ads as $a)
    <div class="mb-3">
        <strong>{{ $a->position }}</strong>
        <div>{!! $a->content !!}</div>
    </div>
@endforeach

<h4>Add Ad</h4>
<form method="post" action="/ads">
    @csrf
    <input name="position" class="form-control mb-2" placeholder="position">
    <textarea name="content" class="form-control mb-2" placeholder="HTML content"></textarea>
    <button class="btn btn-primary">Save</button>
</form>

@endsection
