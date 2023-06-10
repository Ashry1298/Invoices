<?php

namespace App\Http\Controllers\UIController;

use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   
    public function index()
    {

        $paidName = __('main.paidInv');
        $unPaidName = __('main.unPaidInv');
        $partialName = __('main.partialInv');
        $invperc = __('main.invPercen');
        // ExampleController.php
        $totalCount = Invoice::where('id', '!=', 0)->count();
        if ($totalCount) {
            $paid = Invoice::where('status', 1)->count();
            $unPaid = Invoice::where('status', 2)->count();
            $Partial = Invoice::where('status', 3)->count();
            $paidPerc = round(($paid / $totalCount) * 100, 2);
            $UnPaidPerc = round(($unPaid / $totalCount) * 100, 2);
            $partialPerc = round(($Partial / $totalCount) * 100, 2);
            $chartjs = app()->chartjs
                ->name('barChartTest')
                ->type('bar')
                ->size(['width' => 100, 'height' => 100])
                ->labels([$paidName, $unPaidName, $partialName])
                ->datasets([
                    [
                        "label" => $invperc,
                        'backgroundColor' => ['#48d6a8', '#f7778c', '#efa65f'],
                        'data' => [$paidPerc, $UnPaidPerc, $partialPerc]
                    ],

                ])
                ->options([]);
        }
        $totalInvoice = Invoice::where('id', '!=', 0)->sum('total');
        if ($totalInvoice) {
            $paidtotalInvoice = Invoice::where('status', 1)->sum('total');
            $unPaidtotalInvoice = Invoice::where('status', 2)->sum('total');
            $PartialtotalInvoice = Invoice::where('status', 3)->sum('total');
            $paidTotalInvoicePercent = round(($paidtotalInvoice / $totalInvoice) * 100, 2);
            $unPaidTotalInvoicePercent = round(($unPaidtotalInvoice / $totalInvoice) * 100, 2);
            $PartialTotalInvoicePercent = round(($PartialtotalInvoice / $totalInvoice) * 100, 2);
            $chartjs2 = app()->chartjs
                ->name('pieChartTest')
                ->type('pie')
                ->size(['width' => 200, 'height' => 200])
                ->labels([$paidName, $unPaidName, $partialName])
                ->datasets([
                    [
                        'backgroundColor' => ['#48d6a8', '#f7778c', '#efa65f'],
                        'data' => [$paidTotalInvoicePercent, $unPaidTotalInvoicePercent, $PartialTotalInvoicePercent],
                    ]
                ])
                ->options([]);
        }
        if ($totalCount || $totalInvoice) {
            return view('home', compact('chartjs', 'chartjs2'));
        }
        return view('home');
    }
}
