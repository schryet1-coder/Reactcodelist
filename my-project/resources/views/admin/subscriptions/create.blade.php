@extends('layouts.app')

@section('content')
<h3>Create Subscription</h3>
<form method="post" action="/admin/subscriptions">
    @csrf
    <div class="mb-2"><input name="name" class="form-control" placeholder="Name"></div>
    <div class="mb-2"><input name="price" class="form-control" placeholder="Price"></div>
    <div class="mb-2"><input name="period_days" class="form-control" placeholder="Period days"></div>
    <div class="mb-2"><textarea name="features" class="form-control" placeholder='JSON features'></textarea></div>
    <button class="btn btn-primary">Create</button>
 </form>
@endsection
