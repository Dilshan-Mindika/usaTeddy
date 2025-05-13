<div>
    <x-slot:header>Accounts Summary</x-slot:header>

    <div class="mb-3">
        <input class="form-control bg-inv-secondary" type="month" wire:model.live='month'>
    </div>
    <div class="row mb-3">
        <!-- Revenue and Sales -->
        <div class="col-md-7">
            <div class="card text-center shadow-sm bg-inv-secondary text-inv-primary">
                <div class="card-body">
                    <i class="bi bi-currency-exchange display-4 text-inv-primary"></i>
                    <h5 class="card-title mt-2">Total Revenue</h5>
                    <p class="fs-3 fw-bold">RS {{ number_format($total_revenue, 2) }}</p>
                    <p class="text-{{ $revenueDeviation > 0 ? 'success' : 'danger' }}">
                        {{ number_format($revenueDeviation * 100) }}%
                        compared to last month</p>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-12">
            <div class="card bg-inv-primary">
                <div class="card-header text-inv-secondary">
                    <h5>Generate Documents for {{ Carbon\Carbon::parse($month)->format('F Y') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <button class="btn btn-secondary"
                                wire:click="downloadPLStatement('{{ $month }}')">Profit & Loss Statement</button>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-secondary"
                                wire:click="downloadAccountSummary('{{ $month }}')">Accounts
                                Summary</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <div class="row mb-3">

        <div class="card bg-inv-secondary" style="min-height: 32rem">
            <div class="card-header border-3 border-inv-primary d-flex">
                <h5 class="text-inv-primary">
                    Sales & Purchase Summary
                </h5>
                <div class="ms-auto">

                </div>

            </div>
            <div class="card-body" wire:ignore>
                <livewire:livewire-line-chart :line-chart-model="$lineChartModel" />
            </div>
        </div>
    </div>
</div
