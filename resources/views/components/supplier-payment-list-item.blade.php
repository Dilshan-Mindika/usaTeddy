@props(['supplier', 'purchase_payment'])


<li wire:click='selectSupplier({{ $supplier->id }})'
    class="list-group-item {{ $supplier->id == $purchase_payment->supplier_id ? 'active' : '' }} d-flex justify-content-between">
    <div class="me-auto">
        <h5>{{ $supplier->name }}</h5>
        <small class="text-muted">{{ $supplier->email }} <br> {{ $supplier->phone_number }}</small>
    </div>
    <div class="mx-auto my-auto">
        <h6>Account Details:</h6>
        <small class="text-muted">{{ $supplier->bank->name }} <br> {{ $supplier->account_number }}</small>
    </div>
    <div class="ms-auto my-auto {{ $supplier->total_balance > 0 ? 'text-cash-red' : 'text-cash-green' }}">
        <h6>KES {{ number_format($supplier->total_balance, 2) }}</h6>
    </div>
</li>
