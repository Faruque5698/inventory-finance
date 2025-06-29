@extends('backend.layouts.app')
@section('title', 'Add Inventory')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add Inventory</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('inventories.index') }}">Inventory List</a></li>
                <li class="breadcrumb-item active">Add Inventory</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-warehouse me-1"></i>
                    Inventory Entry Form
                </div>
                <div class="card-body">
                    <form action="{{ route('inventories.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="product_id" class="form-label">Select Product <span class="text-danger">*</span></label>
                            <select name="product_id" id="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                                <option value="">-- Choose Product --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_quantity" class="form-label">Total Quantity <span class="text-danger">*</span></label>
                            <input type="number"
                                   name="total_quantity"
                                   id="total_quantity"
                                   class="form-control @error('total_quantity') is-invalid @enderror"
                                   value="{{ old('total_quantity', 0) }}"
                                   required>
                            @error('total_quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="current_quantity" class="form-label">Current Quantity <span class="text-danger">*</span></label>
                            <input type="number"
                                   name="current_quantity"
                                   id="current_quantity"
                                   class="form-control @error('current_quantity') is-invalid @enderror"
                                   value="{{ old('current_quantity', 0) }}"
                                   required>
                            @error('current_quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Add Inventory</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
