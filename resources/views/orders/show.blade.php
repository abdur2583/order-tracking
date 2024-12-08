@extends('admin') <!-- Extend your layout -->

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Order Details</h1>

    <div class="card">
        <div class="card-header">
            <h3>Order #{{ $order->id }}</h3>
        </div>
        <div class="card-body">
            <h5 class="mb-3">Customer Details</h5>
            <p><strong>Name:</strong> {{ $order->user->name }}</p>
            <p><strong>Phone:</strong> {{ $order->user->phone }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
            <h5 class="mt-4 mb-3">Order Details</h5>
            <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
            <p><strong>Status:</strong>     
                <span class="badge 
                    {{ $order->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><strong>Created At:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
            <p><strong>Created At:</strong> {{ $order->updated_at->format('d M Y, h:i A') }}</p>

            <h5 class="mt-4 mb-3">Shipping Address</h5>
            @if($order->shippingAddress)
                <p><strong> Address 1: </strong> {{ $order->shippingAddress->address_line_1 }}</p>
                <p><strong> Address 2: </strong> {{ $order->shippingAddress->address_line_2 }}</p>
                <p><strong> City: </strong>{{ $order->shippingAddress->city }}, <strong>State: </strong> {{ $order->shippingAddress->state }}</p>
                <p><strong> ZIP Code: </strong>{{ $order->shippingAddress->postal_code }}</p>
            @else
                <p class="text-muted">No shipping address available.</p>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('dashboard.all-orders') }}" class="btn btn-primary">Back to Orders</a>
    </div>
</div>
@endsection
