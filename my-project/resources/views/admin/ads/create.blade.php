@extends('layouts.app')

@section('content')
<h3>Create Ad</h3>
<form method="post" action="/admin/ads">
    @csrf
    <div class="mb-2"><input name="position" class="form-control" placeholder="Position"></div>
    <div class="mb-2"><textarea name="content" class="form-control" placeholder="HTML content"></textarea></div>
    <button class="btn btn-primary">Create</button>
 </form>
@endsection
