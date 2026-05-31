@extends('layouts.app')

@section('content')
<h3>Subscription Plans</h3>
@foreach($plans as $p)
    <div class="card mb-3 p-3">
        <h5>{{ $p->name }} - ${{ $p->price }}</h5>
        <p>Period days: {{ $p->period_days }}</p>
        <form method="post" action="/subscriptions/checkout/{{ $p->id }}">
            @csrf
            <button class="btn btn-primary">Subscribe</button>
        </form>
    </div>
@endforeach
@endsection
