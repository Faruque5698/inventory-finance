@extends('backend.layouts.app')

@section('title', 'Sales')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Sale List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Sale List</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-receipt me-1"></i>
                        <strong>All Sales</strong>
                    </div>

                    <form action="{{ route('sales.index') }}" method="GET" class="d-flex gap-2 align-items-center">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                               placeholder="Search invoice no">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Reset</a>
                    </form>

                    <a href="{{ route('sales.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Add Sale
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Invoice No</th>
                            <th>Sale Date</th>
                            <th>Total Amount</th>
                            <th>Discount</th>
                            <th>VAT</th>
                            <th>Net Amount</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>{{ $sale->invoice_no }}</td>
                                <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d M Y') }}</td>
                                <td>{{ number_format($sale->total_amount, 2) }} </td>
                                <td>{{ number_format($sale->discount, 2) }} </td>
                                <td>{{ number_format($sale->vat, 2) }} </td>
                                <td>{{ number_format($sale->net_amount, 2) }} </td>
                                <td>{{ number_format($sale->paid_amount, 2) }} </td>
                                <td>{{ number_format($sale->due_amount, 2) }} </td>
                                <td> <span class="badge
                                    @if($sale['status'] === 'paid') bg-success
                                    @elseif($sale['status'] === 'due') bg-warning
                                    @else bg-secondary
                                    @endif">
                                    {{ ucfirst($sale['status']) }}
                                </span>
                                </td>
                                <td>{{ $sale->created_at->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-info">View</a>
                                    <form action="{{ route('sales.destroy', $sale) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this sale?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No sales found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $sales->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
