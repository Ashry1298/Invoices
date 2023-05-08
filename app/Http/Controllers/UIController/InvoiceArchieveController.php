<?php

namespace App\Http\Controllers\UiController;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class InvoiceArchieveController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    function __construct()
    {
        $this->middleware('permission:ارشيف الفواتير', ['only' => ['index']]);  
    }
    public function index()
    {
        $archievedInvoices = Invoice::withTrashed()->where('deleted_at', '!=', null)->get();
        return view('invoices.archieve', compact('archievedInvoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function restore($id)
    {
        $restoredInvoice=Invoice::withTrashed()->where('id', $id)->restore();
        return redirect()->route('invoices.index')->with('restore_invoice','تم استعادة الفاتورة بنجاح');
    }
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy ($id)
    {
        $invoice=Invoice::withTrashed()-> where('id', $id)->first();
        $file_name = DB::table('invoice_attachments')->where('invoice_id', $invoice->id)->select('file_name')->first();
        $invoice->forceDelete();
        Storage::disk('public_uploads')->deleteDirectory('/' . $invoice->invoice_number);
        return redirect()->route('invoices.index')->with('success_delete', 'تم حذف الفاتوره بنجاح');
    }
}
