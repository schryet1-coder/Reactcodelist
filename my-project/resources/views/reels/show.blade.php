@extends('layouts.app')

@section('content')
<h3>{{ $reel->title }}</h3>
<video width="640" controls src="{{ asset('storage/' . $reel->path) }}"></video>
@endsection
