<?php

namespace App\Http\Controllers\UiController;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Invoices_details;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class InvoicesDetailsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:حذف المرفق', ['only' => ['destroy']]);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = Invoice::findorfail($id);
        $invoices_details = Invoices_details::where('invoice_id', $invoice->id)->get();
        $invoice_attachments = DB::table('invoice_attachments')->where('invoice_id', $invoice->id)->get();
        return view('invoices.show-details', compact('invoice', 'invoices_details', 'invoice_attachments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoices_details $invoices_details)
    {
        //
    }
    public function get_file($id, $invoice_number)
    {
        $result = DB::table('invoice_attachments')->where('invoice_id', $id)->select('invoice_number', 'file_name')->first();
        Storage::disk('public_uploads')->get('Attachments/Invoices/' . $result->invoice_number . '/' . $result->file_name);

        // return Storage::disk('public_uploads')->get($invoice_number . '/' . $result->file_name);
    }
    public function download_file($id, $invoice_number)
    {
        $result = DB::table('invoice_attachments')->where('invoice_id', $id)->first('file_name');
        // $path = public_path($invoice_number . '/' . $result->file_name);
        return Storage::disk('public_uploads')->download($invoice_number . '/' . $result->file_name);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        Storage::disk('public_uploads')->delete('/'.$request->invoice_number.'/'.$request->file_name);
        DB::table('invoice_attachments')->where('file_name', $request->file_name)->delete();
        return back()->with('success_delete', 'تم حذف المرفق بنجاح');
    }
}
