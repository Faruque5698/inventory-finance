@extends('backend.layouts.app')
@section('title', 'Edit Inventory')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Inventory</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('inventories.index') }}">Inventory List</a></li>
                <li class="breadcrumb-item active">Edit Inventory</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit me-1"></i>
                    Inventory Edit Form
                </div>
                <div class="card-body">
                    <form action="{{ route('inventories.update', $inventory->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" value="{{ $inventory->product->name ?? 'N/A' }}" disabled>

                            <input type="hidden"
                                   name="product_id"
                                   value="{{ $inventory->product_id }}"
                                   class="@error('product_id') is-invalid @enderror">

                            @error('product_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_quantity" class="form-label">Total Quantity <span class="text-danger">*</span></label>
                            <input type="number"
                                   name="total_quantity"
                                   id="total_quantity"
                                   class="form-control @error('total_quantity') is-invalid @enderror"
                                   value="{{ old('total_quantity', $inventory->total_quantity) }}"
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
                                   value="{{ old('current_quantity', $inventory->current_quantity) }}"
                                   required>
                            @error('current_quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Inventory</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
