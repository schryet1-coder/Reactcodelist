@extends('layouts.app')

@section('content')
<h3>Matches</h3>
<ul>
@foreach($matches as $m)
    <li><a href="/matches/{{ $m->id }}">{{ $m->title }}</a></li>
@endforeach
</ul>
@endsection
