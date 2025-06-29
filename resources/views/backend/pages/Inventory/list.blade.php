@extends('backend.layouts.app')
@section('title', 'Inventory')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Inventory List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Inventory</li>
            </ol>

            <div class="card mb-4">


                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-warehouse me-1"></i>
                        <strong>All Inventory</strong>
                    </div>

                    <div class="mx-auto">
                        <form action="{{ route('inventories.index') }}" method="GET"
                              class="d-flex gap-2 align-items-center">
                            <select name="product_id" class="form-select">
                                <option value="">-- All Products --</option>
                                @foreach($products as $product)
                                    <option
                                        value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('inventories.index') }}" class="btn btn-secondary">Reset</a>
                        </form>
                    </div>

                    <div>
                        <a href="{{ route('inventories.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Add Inventory
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                    <tr>
                        <th>#ID</th>
                        <th>Product Name</th>
                        <th>Slug</th>
                        <th>Code</th>
                        <th>Total Quantity</th>
                        <th>Current Quantity</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->id }}</td>
                            <td>{{ $inventory->product->name ?? 'N/A' }}</td>
                            <td>{{ $inventory->product->slug ?? 'N/A' }}</td>
                            <td>{{ $inventory->code }}</td>
                            <td>{{ $inventory->total_quantity }}</td>
                            <td>{{ $inventory->current_quantity }}</td>
                            <td>{{ \Carbon\Carbon::parse($inventory->created_at)->format('d M, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($inventory->updated_at)->format('d M, Y') }}</td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('inventories.show', $inventory) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('inventories.edit', $inventory->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this inventory?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No inventory records found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-4">
                    {{ $inventories->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
