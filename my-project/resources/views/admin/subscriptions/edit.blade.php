@extends('layouts.app')

@section('content')
<h3>Edit Subscription</h3>
<form method="post" action="/admin/subscriptions/{{ $subscription->id }}">
    @csrf
    <div class="mb-2"><input name="name" value="{{ $subscription->name }}" class="form-control"></div>
    <div class="mb-2"><input name="price" value="{{ $subscription->price }}" class="form-control"></div>
    <div class="mb-2"><input name="period_days" value="{{ $subscription->period_days }}" class="form-control"></div>
    <div class="mb-2"><textarea name="features" class="form-control">{{ json_encode($subscription->features) }}</textarea></div>
    <button class="btn btn-primary">Save</button>
 </form>
@endsection
