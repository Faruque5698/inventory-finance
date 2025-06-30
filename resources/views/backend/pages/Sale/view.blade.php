@extends('backend.layouts.app')

@section('title', 'View Sale')

@section('content')
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="mb-4">Sale Details</h2>

                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>Invoice No</th>
                            <td>{{ $sale['invoice_no'] }}</td>
                        </tr>
                        <tr>
                            <th>Sale Date</th>
                            <td>{{ \Carbon\Carbon::parse($sale['sale_date'])->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Total Amount</th>
                            <td>{{ number_format($sale['total_amount'], 2) }} TK</td>
                        </tr>
                        <tr>
                            <th>Discount</th>
                            <td>{{ number_format($sale['discount'], 2) }} TK</td>
                        </tr>
                        <tr>
                            <th>VAT</th>
                            <td>{{ number_format($sale['vat'], 2) }} TK</td>
                        </tr>
                        <tr>
                            <th>Net Amount</th>
                            <td>{{ number_format($sale['net_amount'], 2) }} TK</td>
                        </tr>
                        <tr>
                            <th>Paid Amount</th>
                            <td>{{ number_format($sale['paid_amount'], 2) }} TK</td>
                        </tr>
                        <tr>
                            <th>Due Amount</th>
                            <td>{{ number_format($sale['due_amount'], 2) }} TK</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge
                                    @if($sale['status'] === 'paid') bg-success
                                    @elseif($sale['status'] === 'due') bg-warning
                                    @else bg-secondary
                                    @endif">
                                    {{ ucfirst($sale['status']) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ \Carbon\Carbon::parse($sale['created_at'])->format('d M Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ \Carbon\Carbon::parse($sale['updated_at'])->format('d M Y, h:i A') }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4 class="mt-5">Sale Items</h4>
                    <table class="table table-bordered table-sm">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $items = isset($sale['items'][0]) ? $sale['items'] : [$sale['items']]; @endphp
                        @foreach($items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['name'] ?? 'N/A' }}</td>
                                <td>{{ $item['quantity'] ?? 'N/A' }}</td>
                                <td>{{ number_format($item['unit_price'] ?? 0, 2) }} TK</td>
                                <td>{{ number_format($item['subtotal'] ?? 0, 2) }} TK</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary">← Back to Sales List</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
