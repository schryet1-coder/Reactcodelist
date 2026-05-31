@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h2 class="mb-3">Thank you for your purchase!</h2>
                <p class="text-muted mb-4">Your subscription payment has been initiated. Once Stripe confirms the payment, your membership will be activated automatically.</p>
                <a href="/dashboard" class="btn btn-primary">Return to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
