@extends('layouts.app')

@section('content')
<h3>{{ $channel->name }}</h3>
<pre>{{ json_encode($channel->meta) }}</pre>
@endsection
