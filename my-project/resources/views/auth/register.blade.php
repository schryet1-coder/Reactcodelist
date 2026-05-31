@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-5 col-lg-6 col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4 class="mb-3">Create a new account</h4>
                <form method="post" action="{{ url('/register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required autofocus>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button class="btn btn-primary w-100">Register</button>
                </form>
            </div>
            <div class="card-footer bg-white text-center py-3">
                <small>Already registered? <a href="{{ url('/login') }}">Login here</a></small>
            </div>
        </div>
    </div>
</div>
@endsection
