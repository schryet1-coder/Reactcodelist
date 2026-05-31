@extends('layouts.app')

@section('content')
<h2>Dashboard</h2>

<div class="row">
  <div class="col-md-6">
    <h4>Fetch channels by Extreme code</h4>
    <form method="post" action="{{ url('/fetch-extreme') }}">
      @csrf
      <div class="mb-3"><input name="code" class="form-control" placeholder="Extreme code"></div>
      <button class="btn btn-primary">Fetch Channels</button>
    </form>
  </div>

  <div class="col-md-6">
    <h4>Scrape matches from site</h4>
    <form method="post" action="{{ url('/fetch-matches') }}">
      @csrf
      <div class="mb-3"><input name="site_url" class="form-control" placeholder="https://example.com/feed"></div>
      <button class="btn btn-primary">Scrape Matches</button>
    </form>
  </div>
</div>

@endsection
