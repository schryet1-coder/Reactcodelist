@extends('layouts.app')

@section('content')
<h3>{{ $match->title }}</h3>
<p>External: <a href="{{ $match->external_url }}">{{ $match->external_url }}</a></p>
@endsection
