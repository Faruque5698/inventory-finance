@extends('backend.layouts.app')

@section('title', 'View Product')

@section('content')
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="mb-4">Product Details</h2>

                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $product->slug ?? null }}</td>
                        </tr>
                        <tr>
                            <th>Purchase Price</th>
                            <td>{{ number_format($product->purchase_price, 2) }} TK</td>
                        </tr>
                        <tr>
                            <th>Sell Price</th>
                            <td>{{ number_format($product->sell_price, 2) }} TK</td>
                        </tr>
                        <tr>
                            <th>Discount</th>
                            <td>{{ $product->discount ?? '0' }}</td>
                        </tr>
                        <tr>
                            <th>Discount Type</th>
                            <td>{{ ucfirst($product->discount_type ?? 'N/A') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge
                                    @if($product->status === 'active') bg-success
                                    @elseif($product->status === 'inactive') bg-danger
                                    @else bg-secondary
                                    @endif">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="Product Image" width="150">
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Created At</th>
                            <td>{{ $product->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $product->updated_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">← Back to Product List</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
