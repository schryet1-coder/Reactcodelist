@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-5 col-lg-6 col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4 class="mb-3">Login to your account</h4>
                <form method="post" action="{{ url('/login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button class="btn btn-primary w-100">Login</button>
                </form>
            </div>
            <div class="card-footer bg-white text-center py-3">
                <small>Don't have an account? <a href="{{ url('/register') }}">Register now</a></small>
            </div>
        </div>
    </div>
</div>
@endsection
