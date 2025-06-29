@extends('backend.layouts.app')

@section('title', 'Edit Product')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Product</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product List</a></li>
                <li class="breadcrumb-item active">Edit Product</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-box me-1"></i>
                    Product Update Form
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $product->name) }}"
                                   required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $product->slug }}"
                                   readonly>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file"
                                   name="image"
                                   id="image"
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="mt-2">
                                <img id="imagePreview" src="{{ asset($product->image) }}" alt="Image Preview" style="max-height: 150px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="purchase_price" class="form-label">Purchase Price (TK) <span class="text-danger">*</span></label>
                            <input type="number"
                                   name="purchase_price"
                                   id="purchase_price"
                                   step="0.001"
                                   class="form-control @error('purchase_price') is-invalid @enderror"
                                   value="{{ old('purchase_price', $product->purchase_price) }}"
                                   required>
                            @error('purchase_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sell_price" class="form-label">Sell Price (TK) <span class="text-danger">*</span></label>
                            <input type="number"
                                   name="sell_price"
                                   id="sell_price"
                                   step="0.001"
                                   class="form-control @error('sell_price') is-invalid @enderror"
                                   value="{{ old('sell_price', $product->sell_price) }}"
                                   required>
                            @error('sell_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Discount --}}
                        <div class="mb-3">
                            <label for="discount" class="form-label">Discount Value</label>
                            <input type="number"
                                   name="discount"
                                   id="discount"
                                   step="0.01"
                                   class="form-control @error('discount') is-invalid @enderror"
                                   value="{{ old('discount', $product->discount ?? 0) }}">
                            @error('discount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Discount Type --}}
                        <div class="mb-3">
                            <label for="discount_type" class="form-label">Discount Type</label>
                            <select name="discount_type"
                                    id="discount_type"
                                    class="form-select @error('discount_type') is-invalid @enderror">
                                <option value="flat" {{ old('discount_type', $product->discount_type) === 'flat' ? 'selected' : '' }}>Flat (TK)</option>
                                <option value="%" {{ old('discount_type', $product->discount_type) === '%' ? 'selected' : '' }}>% Percentage</option>
                            </select>
                            @error('discount_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status"
                                    id="status"
                                    class="form-select @error('status') is-invalid @enderror"
                                    required>
                                <option value="active" {{ old('status', $product->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $product->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
