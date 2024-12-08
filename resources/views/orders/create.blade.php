@extends('admin') <!-- Extend your layout -->

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Create Order</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <!-- Customer Details -->
        <div class="card mb-4">
            <div class="card-header">Customer Details</div>
            <div class="card-body">
                {{-- <div class="mb-3">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                    @error('customer_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div> --}}
                <div class="mb-3">
                    <label for="total_amount" class="form-label">Total Amount</label>
                    <input type="number" step="0.01" name="total_amount" id="total_amount" class="form-control" value="{{ old('total_amount') }}" required>
                    @error('total_amount') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>Progress</option>
                        <option value="delivered" {{ old('status') == 'delivered' ? 'selected' : '' }}>delivered</option>
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        {{-- <!-- Shipping Address -->
        <div class="card mb-4">
            <div class="card-header">Shipping Address</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="address_line" class="form-label">Address Line</label>
                    <input type="text" name="address_line" id="address_line" class="form-control" value="{{ old('address_line') }}" required>
                    @error('address_line') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" required>
                    @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">State</label>
                    <input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}" required>
                    @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="zip_code" class="form-label">ZIP Code</label>
                    <input type="text" name="zip_code" id="zip_code" class="form-control" value="{{ old('zip_code') }}" required>
                    @error('zip_code') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div> --}}

        <!-- Submit Button -->
        <div class="text-end">
            <button type="submit" class="btn btn-success">Create Order</button>
            <a href="{{ route('dashboard.all-orders') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
  
</div>
@endsection
