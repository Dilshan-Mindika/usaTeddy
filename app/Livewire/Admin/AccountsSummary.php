<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchasePayment;
use App\Models\Sale;
use App\Models\SalesPayment;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;

class AccountsSummary extends Component
{
    public $total_revenue = 0;
    public $revenueDeviation = 0;
    public $revenuePrevious = 0;
    public $sales_count = 0;
    public $stock_value = 0;

    public $receivables = 0;
    public $overdue_invoices = 0;
    public $loss_summary = 0;

    public $instance;
    public $month;
    public $previousMonth;


    function updatedMonth()
    {
        $this->instance = Carbon::parse($this->month);
        $this->total_revenue = $this->getTotalRevenue($this->instance->format('Y-m'));
        $this->revenuePrevious = $this->getTotalRevenue($this->instance->subMonth()->format('Y-m'));

        if ($this->total_revenue  !== 0) {
            $this->revenueDeviation = ($this->total_revenue - $this->revenuePrevious) / $this->total_revenue;
        }
    }


    function getOpeningStock($month)
    {
        $salesValue = 0;
        $purchasesValue = 0;
        $openingDate = Carbon::parse($month)->firstOfMonth()->toDateString();
        foreach (Sale::all() as $key => $sale) {
            if (Carbon::parse($sale->sale_date)->isBefore($openingDate)) {
                $salesValue += $sale->total_value;
            }
        }
        foreach (Purchase::all() as $key => $purchase) {
            if (Carbon::parse($purchase->purchase_date)->isBefore($openingDate)) {
                $purchasesValue += $purchase->total_value;
            }
        }

        return $purchasesValue - $salesValue;
    }
    function getClosingStock($month)
    {

        $salesValue = 0;
        $purchasesValue = 0;
        $openingDate = Carbon::parse($month)->addMonth()->firstOfMonth()->toDateString();
        foreach (Sale::all() as $key => $sale) {
            if (Carbon::parse($sale->sale_date)->isBefore($openingDate)) {
                $salesValue += $sale->total_value;
            }
        }
        foreach (Purchase::all() as $key => $purchase) {
            if (Carbon::parse($purchase->purchase_date)->isBefore($openingDate)) {
                $purchasesValue += $purchase->total_value;
            }
        }

        return $purchasesValue - $salesValue;
    }

    function getTotalRevenue($month)
    {
        $total = 0;
        foreach (Sale::all() as $key => $sale) {
            if (Carbon::parse($sale->sale_date)->format('Y-m') == $month) {
                $total += $sale->total_amount;
            }
        }

        return $total;
    }
    function getTotalPurchases($month)
    {
        $total = 0;
        foreach (Purchase::all() as $key => $purchase) {
            if (Carbon::parse($purchase->purchase_date)->format('Y-m') == $month) {
                $total += $purchase->total_amount;
            }
        }

        return $total;
    }
    function getTotalSalesPayments($month)
    {
        $total = 0;
        foreach (SalesPayment::all() as $key => $payment) {
            if (Carbon::parse($payment->payment_time)->format('Y-m') == $month) {
                $total += $payment->amount;
            }
        }

        return $total;
    }
    function getTotalPurchasePayments($month)
    {
        $total = 0;
        foreach (PurchasePayment::all() as $key => $payment) {
            if (Carbon::parse($payment->payment_time)->format('Y-m') == $month) {
                $total += $payment->amount;
            }
        }

        return $total;
    }

    function downloadPLStatement($month)
    {
        $pdf = Pdf::loadView('pdf.profitloss', [
            'date' => Carbon::parse($month)->endOfMonth()->format('jS F, Y'),
            'opening_stock' => $this->getOpeningStock($month),
            'closing_stock' => $this->getClosingStock($month),
            'total_revenue' => $this->getTotalRevenue($month),
            'total_purchases' => $this->getTotalPurchases($month),
        ]);
        return response()->streamDownload(function () use ($pdf) {
            echo  $pdf->stream();
        }, Carbon::parse($month)->endOfMonth()->format('m-Y') . ' - Profit & Loss Statement.pdf');
    }
    function downloadAccountSummary($month)
    {
        $pdf = Pdf::loadView('pdf.account-summary', [
            'date' => Carbon::parse($month)->format('F, Y'),
            'total_sales' => $this->getTotalRevenue($month),
            'total_sales_payments' => $this->getTotalSalesPayments($month),
            'total_purchases' => $this->getTotalPurchases($month),
            'total_purchase_payments' => $this->getTotalPurchasePayments($month),
        ]);
        return response()->streamDownload(function () use ($pdf) {
            echo  $pdf->stream();
        }, Carbon::parse($month)->endOfMonth()->format('m-Y') . ' - Accounts Summary Statement.pdf');
    }
    function mount()
    {

        $this->instance = Carbon::now();
        $this->month = $this->instance->format('Y-m');
        $this->total_revenue = $this->getTotalRevenue($this->instance->format('Y-m'));
        $this->revenuePrevious = $this->getTotalRevenue($this->instance->subMonth()->format('Y-m'));

        if ($this->total_revenue  !== 0) {
            $this->revenueDeviation = ($this->total_revenue - $this->revenuePrevious) / $this->total_revenue;
        }
    }


    function getSalesChart()
    {
        // Generate a period of the last 5 months
        $date = $this->instance->toDateString();
        $end = Carbon::parse($date);
        $start = Carbon::parse($date)->subMonthsNoOverflow(6);
        $period = CarbonPeriod::since($start)->months(1)->until($end);

        // Map the period to an array of month names or desired format

        $months = [];
        foreach ($period as $key => $month) {
            array_push($months, $month->format('Y-m'));
        }
        $lineChartModel = LivewireCharts::multiLineChartModel();

        // dd($months);
        foreach ($months as $key => $month) {
            $lineChartModel->addSeriesPoint("Sales ",  Carbon::parse($month)->format('F Y'), $this->getTotalRevenue($month));
            $lineChartModel->addSeriesPoint("Purchases ", Carbon::parse($month)->format('F Y'),  $this->getTotalPurchases($month));
        }
        $lineChartModel->setAnimated('ease-in');
        $lineChartModel->setSmoothCurve();
        $lineChartModel->setColors(["#336699", "#f29f67"]);
        $lineChartModel->setDataLabelsEnabled(true);
        // $lineChartModel


        $lineChartModel->setJsonConfig([
            'tooltip.y.formatter' => '(val) => `KES ${val.toLocaleString()}`',
            // 'chart'=>"area"
        ]);

        return $lineChartModel;
    }
    public function render()
    {

        // return $this->getSalesChart();
        return view('livewire.admin.accounts-summary', [
            'lineChartModel' => $this->getSalesChart()
        ]);
    }
}
