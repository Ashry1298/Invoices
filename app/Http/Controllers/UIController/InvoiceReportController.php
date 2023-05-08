<?php

namespace App\Http\Controllers\UiController;

use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\InvoiceSearchRequest;
use App\Http\Controllers\Controller;

class InvoiceReportController extends Controller
{
   function __construct()
   {
      $this->middleware('permission:تقارير الفواتير', ['only' => ['index']]);
   }
   public function index()
   {
      $invoices = Invoice::pluck('invoice_number')->all();
      return view('reports.invoices');
   }

   public function invoicesSearch(Request $request)
   {
      $status = Invoice::pluck('status', 'status')->all();
      // فى حاله البحث عن طريق تحديد نوع الفاتوره 
      if ($request->radio == 1) {
         // فى حاله البحث عن طريق تحديد نوع الفاتوره بدون تحديد للتاريخ
         if ($request->status && $request->start_at == null && $request->end_at == null) {

            if (in_array($request->status, $status)) {
               $invoices = Invoice::where('status', $request->status)->get();
               $status = $request->status;
               return view('reports.invoices', compact('status', 'invoices'));
            }
            $invoices = Invoice::get();
            return view('reports.invoices', compact('status', 'invoices'));
         } elseif ($request->status && $request->start_at && $request->end_at) {
            // فى حاله البحث عن طريق تحديد نوع الفاتوره  بتحديد للتاريخ
            // );
            if (in_array($request->status, $status)) {
               $invoices = Invoice::whereBetween('invoice_date', [$request->start_at, $request->end_at])
                  ->where('status', $request->status)->get();
               return view('reports.invoices', compact('status', 'invoices'));
            }
            $invoices = Invoice::whereBetween('invoice_date', [$request->start_at, $request->end_at])->get();
            return view('reports.invoices', compact('status', 'invoices'));
         } else {

            return redirect()->route('reports.invoices');
         }
      } else {
         $invoices = Invoice::where('invoice_number', $request->invoice_number)->get();
         return view('reports.invoices', compact('invoices'));
      }
   }
}
