@extends('layouts.app')

@section('content')
<h3>Admin - Ads</h3>
@foreach($ads as $a)
    <div class="card p-3 mb-2">
        <strong>{{ $a->position }}</strong>
        <div>{!! $a->content !!}</div>
    </div>
@endforeach
@endsection
