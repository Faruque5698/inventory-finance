@extends('backend.layouts.app')

@section('title', 'Add Sale')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add Sale</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Sale List</a></li>
                <li class="breadcrumb-item active">Add Sale</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-cash-register me-1"></i>
                    Sale Entry Form
                </div>
                <div class="card-body">
                    <form action="{{ route('sales.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="sale_date" class="form-label">Sale Date <span class="text-danger">*</span></label>
                            <input type="date" name="sale_date" id="sale_date" class="form-control @error('sale_date') is-invalid @enderror"
                                   value="{{ old('sale_date', date('Y-m-d')) }}" required>
                            @error('sale_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Product Dropdown --}}
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Select Product <span class="text-danger">*</span></label>
                            <select name="product_id"
                                    id="product_id"
                                    class="form-select @error('product_id') is-invalid @enderror"
                                    required>
                                <option value="">-- Select Product --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}"
                                            data-price="{{ $product->sell_price }}"
                                            data-discount="{{ $product->discount }}"
                                            data-type="{{ $product->discount_type }}"
                                        {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }} — Tk {{ $product->sell_price }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" id="quantity" min="1" class="form-control" value="{{ old('quantity', 1) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="unit_price" class="form-label">Unit Price (TK)</label>
                            <input type="number" step="0.01" name="unit_price" id="unit_price" class="form-control" value="{{ old('unit_price', 0) }}">
                        </div>

                        <div class="mb-3">
                            <label for="discount" class="form-label">Discount Applied</label>
                            <input type="number" step="0.01" name="discount" id="discount" class="form-control" value="{{ old('discount', 0) }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="total_amount" class="form-label">Total Amount (after discount)</label>
                            <input type="number" step="0.01" name="total_amount" id="total_amount" class="form-control" value="{{ old('total_amount', 0) }}">
                        </div>

                        <div class="mb-3">
                            <label for="vat" class="form-label">VAT</label>
                            <input type="number" step="0.01" name="vat" class="form-control" value="{{ old('vat', 0) }}">
                        </div>

                        <div class="mb-3">
                            <label for="net_amount" class="form-label">Net Amount</label>
                            <input type="number" name="net_amount" id="net_amount" step="0.01" class="form-control" value="{{ old('net_amount', 0) }}">
                        </div>

                        <div class="mb-3">
                            <label for="paid_amount" class="form-label">Paid Amount</label>
                            <input type="number" name="paid_amount" step="0.01" class="form-control" value="{{ old('paid_amount', 0) }}">
                        </div>

                        <div class="mb-3">
                            <label for="due_amount" class="form-label">Due Amount</label>
                            <input type="number" name="due_amount" step="0.01" class="form-control" value="{{ old('due_amount', 0) }}">
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus-circle me-1"></i> Add Sale
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    @push('scripts')
        <script>
            function calculateTotal() {
                const unitPrice = parseFloat(document.getElementById('unit_price').value) || 0;
                const quantity = parseInt(document.getElementById('quantity').value) || 1;
                const totalAmount = unitPrice * quantity;

                document.getElementById('total_amount').value = totalAmount.toFixed(2);

                calculateNetAmount(); // update net
            }

            function calculateNetAmount() {
                const totalAmount = parseFloat(document.getElementById('total_amount').value) || 0;
                const vat = parseFloat(document.querySelector('[name="vat"]').value) || 0;
                const paidAmount = parseFloat(document.querySelector('[name="paid_amount"]').value) || 0;

                const netAmount = totalAmount + vat;
                const dueAmount = netAmount - paidAmount;

                document.getElementById('net_amount').value = netAmount.toFixed(2);
                document.querySelector('[name="due_amount"]').value = dueAmount.toFixed(2);
            }

            document.addEventListener('DOMContentLoaded', function () {
                const productSelect = document.getElementById('product_id');
                const unitPriceInput = document.getElementById('unit_price');
                const discountInput = document.getElementById('discount');
                const quantityInput = document.getElementById('quantity');
                const totalAmountInput = document.getElementById('total_amount');
                const vatInput = document.querySelector('[name="vat"]');
                const paidInput = document.querySelector('[name="paid_amount"]');

                function applyDiscountAndPrice() {
                    const selected = productSelect.options[productSelect.selectedIndex];
                    const basePrice = parseFloat(selected.getAttribute('data-price')) || 0;
                    const discount = parseFloat(selected.getAttribute('data-discount')) || 0;
                    const type = selected.getAttribute('data-type');

                    let finalPrice = basePrice;
                    let discountValue = 0;

                    if (type === '%') {
                        discountValue = (basePrice * discount) / 100;
                        finalPrice = basePrice - discountValue;
                    } else if (type === 'flat') {
                        discountValue = discount;
                        finalPrice = basePrice - discountValue;
                    }

                    unitPriceInput.value = finalPrice.toFixed(2);
                    discountInput.value = discountValue.toFixed(2);
                    calculateTotal();
                }

                productSelect.addEventListener('change', applyDiscountAndPrice);
                quantityInput.addEventListener('input', calculateTotal);
                unitPriceInput.addEventListener('input', calculateTotal);
                vatInput.addEventListener('input', calculateNetAmount);
                paidInput.addEventListener('input', calculateNetAmount);
                totalAmountInput.addEventListener('input', calculateNetAmount);
            });
        </script>
    @endpush

@endpush
