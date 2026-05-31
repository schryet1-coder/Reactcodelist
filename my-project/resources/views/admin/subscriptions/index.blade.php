@extends('layouts.app')

@section('content')
<h3>Admin - Subscriptions</h3>
@foreach($plans as $p)
    <div class="card p-3 mb-2">
        <strong>{{ $p->name }}</strong> - ${{ $p->price }} / {{ $p->period_days }} days
    </div>
@endforeach
@endsection
