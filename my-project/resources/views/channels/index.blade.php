@extends('layouts.app')

@section('content')
<h3>Channels</h3>
<ul>
@foreach($channels as $c)
    <li><a href="/channels/{{ $c->id }}">{{ $c->name }}</a></li>
@endforeach
</ul>
@endsection
