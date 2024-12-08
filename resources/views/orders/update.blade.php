@extends('admin') <!-- Extend your layout -->

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Order</h1>

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('POST')

        <!-- Customer Details -->
        <div class="card mb-4">
            <div class="card-header">Customer Details</div>
            <div class="card-body">
                {{-- <div class="mb-3">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ old('customer_name', $order->customer_name) }}" required>
                    @error('customer_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div> --}}
                <div class="mb-3">
                    <label for="total_amount" class="form-label">Total Amount</label>
                    <input type="number" step="0.01" name="total_amount" id="total_amount" class="form-control" value="{{ old('total_amount', $order->total_amount) }}" required>
                    @error('total_amount') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status', $order->status) == 'in_progress' ? 'selected' : '' }}>Progress</option>
                        <option value="delivered" {{ old('status', $order->status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="card mb-4">
            <div class="card-header">Shipping Address</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="address_line" class="form-label">Address Line</label>
                    <input type="text" name="address_line_1" id="address_line_1" class="form-control" value="{{ old('address_line_1', $order->shippingAddress->address_line_1 ?? '') }}" required>
                    @error('address_line') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="address_line" class="form-label">Address Line 2</label>
                    <input type="text" name="address_line_2" id="address_line_2" class="form-control" value="{{ old('address_line_2', $order->shippingAddress->address_line_2 ?? '') }}" required>
                    @error('address_line') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $order->shippingAddress->city ?? '') }}" required>
                    @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">State</label>
                    <input type="text" name="state" id="state" class="form-control" value="{{ old('state', $order->shippingAddress->state ?? '') }}" required>
                    @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="postal_code" class="form-label">ZIP Code</label>
                    <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code', $order->shippingAddress->postal_code ?? '') }}" required>
                    @error('zip_code') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="zip_code" class="form-label">Country</label>
                    <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $order->shippingAddress->country ?? '') }}" required>
                    @error('zip_code') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-end">
            <button type="submit" class="btn btn-success">Update Order</button>
            <a href="{{ route('dashboard.all-orders') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
