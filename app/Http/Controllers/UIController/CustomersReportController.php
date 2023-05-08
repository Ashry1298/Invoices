<?php

namespace App\Http\Controllers\UiController;

use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomersReportController extends Controller
{   
    function __construct()
    {
       $this->middleware('permission:تقارير العملاء', ['only' => ['index']]);
    }
    public function index()
    {
        $sections = Section::get();
        return view('reports.customers', compact('sections'));
    }
    public function reportsSearch(Request $request)
    {
        if ($request->section && $request->product && $request->start_at == null && $request->end_at == null) {
            $request->validate(
                [
                    'section' => 'required|numeric|regex:/^[0->9]*$/',
                    'product' => 'required|string',
                ]
            );
            $invoices = Invoice::where('section_id', $request->section)->where('product', $request->product)->get();
            $sections = Section::get();
            return view('reports.customers', compact('invoices', 'sections'));
        } elseif ($request->section && $request->product && $request->start_at && $request->end_at) {
            $request->validate(
                [
                    'section' => 'required|numeric|regex:/^[0->9]*$/',
                    'product' => 'required|string',
                    'start_at' => 'required|date',
                    'end_at' => 'required|date',
                ]
            );
            $invoices = Invoice::whereBetween('invoice_date', [$request->start_at, $request->end_at])->where('section_id', $request->section)->where('product', $request->product)->get();
            $sections = Section::get();
            return view('reports.customers', compact('invoices', 'sections'));
        } else {
            return redirect()->route('reports.Customers');
        }
    }
}
