@extends('backend.layouts.app')
@section('title', 'Products')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Product List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Product List</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-box me-1"></i>
                        <strong>All Products</strong>
                    </div>

                    <form action="{{ route('products.index') }}" method="GET" class="d-flex gap-2 align-items-center">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                               placeholder="Search product name">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Reset</a>
                    </form>

                    <a href="{{ route('products.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Add Product
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Purchase Price</th>
                            <th>Sell Price</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->slug }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ number_format($product->purchase_price, 2) }} Tk</td>
                                <td>{{ number_format($product->sell_price, 2) }} Tk</td>
                                <td>
                                        <form action="{{ route('products.update-status', $product->id) }}" method="POST" class="mb-0">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select form-select-sm"
                                                    style="min-width: 120px;" onchange="this.form.submit()">
                                                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>
                                                    ✅ Active
                                                </option>
                                                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>
                                                    ❌ Inactive
                                                </option>
                                            </select>
                                        </form>

                                </td>
                                <td>{{ $product->created_at->format('d M, Y') }}</td>
                                <td>{{ $product->updated_at->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No products found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
