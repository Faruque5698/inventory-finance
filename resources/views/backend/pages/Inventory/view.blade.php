@extends('backend.layouts.app')

@section('title', 'View Inventory')

@section('content')
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="mb-4">Inventory Details</h2>

                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>Product Name</th>
                            <td>{{ $inventory->product->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $inventory->product->slug ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Purchase price</th>
                            <td>{{ $inventory->product->purchase_price ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Sell price</th>
                            <td>{{ $inventory->product->sell_price ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $inventory->product->slug ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Inventory Code</th>
                            <td>{{ $inventory->code }}</td>
                        </tr>
                        <tr>
                            <th>Total Quantity</th>
                            <td>{{ $inventory->total_quantity }}</td>
                        </tr>
                        <tr>
                            <th>Current Quantity</th>
                            <td>{{ $inventory->current_quantity }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $inventory->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $inventory->updated_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <a href="{{ route('inventories.index') }}" class="btn btn-secondary">← Back to Inventory List</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
