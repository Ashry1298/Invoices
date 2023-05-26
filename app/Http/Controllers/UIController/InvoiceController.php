<?php

namespace App\Http\Controllers\UiController;
use App\Models\User;
use Faker\Core\File;
use App\Models\Invoice;
use App\Models\Section;
use App\Mail\AddInvoiceMail;
use Illuminate\Http\Request;
use App\Exports\InvoicesExport;
use App\Models\Invoices_details;
use Illuminate\Support\Facades\DB;
use App\Exports\InvoicesPaidExport;
use App\Notifications\InvoiceCreate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\InvoiceRequest;
use Illuminate\Contracts\Cache\Store;
use App\Exports\InvoicesUnPaidsExport;
use Illuminate\Support\Facades\Storage;
use App\Exports\ArchievedInvoicesExport;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Http\Requests\InvoiceUpdateRequest;
use App\Notifications\InvoiceDelete;
use App\Notifications\InvoiceUpdate;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:القائمه الكامله للفواتير', ['only' => ['index']]);
        $this->middleware('permission:الفواتير المدفوعه', ['only' => ['paidInvoices']]);
        $this->middleware('permission:الفواتير غير المدفوعه', ['only' => ['unPaidInvoices']]);
        $this->middleware('permission:الفواتير المدفوعه جزئيا', ['only' => ['partialInvoices']]);
        $this->middleware('permission:اضافة فاتورة', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل الفاتورة', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف الفاتورة', ['only' => ['destroy']]);
        $this->middleware('permission:تغير حالة الدفع', ['only' => ['show', 'statusUpdate']]);
        $this->middleware('permission:اضافة مرفق', ['only' => ['addAttachment']]);
        $this->middleware('permission:طباعةالفاتورة', ['only' => ['printInvoices']]);
    }
    public function index()
    {
        $invoices = Invoice::get();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::select('section_name', 'id')->get();
        return view('invoices.create', compact('sections'));
    }

    public function getProducts($id)
    {
        $products = DB::table('products')->where('section_id', $id)->pluck('product_name', 'id');
        return json_encode($products);
    }


    public function store(InvoiceRequest $request)
    {

        $invoice_data = $request->validated();
        $invoice_data['user'] = Auth::user()->name;
        $invoice = Invoice::create(
            $invoice_data
        );

        Invoices_details::create([
            // $invoice_data
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->section_id,
            'invoice_id' => $invoice->id,
            'status' => $request->status,
            'payment_date' => $request->Payment_Date,
            'note' => $request->note,
            'user' => Auth::user()->name,
        ]);



        if ($request->file('file')) {
            $ext = $request->file('file')->getClientOriginalExtension();
            $file_name = 'file-' . uniqid() . '.' . $ext;
            $path = $request->file('file')->storeAs($request->invoice_number, $file_name, [
                'disk' => 'public_uploads',
            ]);
            if ($path) {
                DB::table('invoice_attachments')->insert([
                    'file_name' => $file_name,
                    'invoice_number' => $request->invoice_number,
                    'created_by' => Auth::user()->name,
                    'invoice_id' => $invoice->id,
                    'created_at' => now()
                ]);
            }
        }

        // $users = User::where('id', '=', Auth::user()->id)->get();
        $users = User::get();
        Notification::send($users, new InvoiceCreate($invoice->id, $invoice->invoice_number));
        return redirect()->route('invoices.index')->with('success_added', 'تم اضافه الفاتوره بنجاح ');
    }

    public function addAttachment(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png',
        ]);
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $file_name = 'file-' . uniqid() . '.' . $ext;
        $path = $file->storeAs($request->invoice_number, $file_name, [
            'disk' => 'public_uploads',
        ]);
        DB::table('invoice_attachments')->insert(
            [
                'invoice_number' => $request->invoice_number,
                'file_name' => $file_name,
                'created_by' => Auth::user()->name,
                'invoice_id' => $id,
                'created_at' => now(),
            ]
        );
        return back();
    }
    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.status-update', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $sections = Section::all();
        return view('invoices.edit', compact('invoice', 'sections'));
    }

    public function statusUpdate(Request $request, Invoice $invoice)
    {
        $invoice->update([
            'status' => $request->status,
        ]);
        Invoices_details::create(
            [
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section_id,
                'invoice_id' => $invoice->id,
                'Status' => $request->status,
                'Payment_Date' => $request->Payment_Date,
                'note' => $request->note,
                'user' => Auth::user()->name,
            ]
        );
        return redirect()->route('invoices.index')->with('Status_Update', 'تم تغيير حاله الدفع بنجاح');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(InvoiceUpdateRequest $request, Invoice $invoice)
    {
        $current_file_name = DB::table('invoice_attachments')->where('invoice_id', $invoice->id)->select('file_name')->first();
        $invoice_data = $request->validated();
        $invoice_data['user'] = Auth::user()->name;
        $invoice->update([
            // $invoice_data,
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section_id,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'rate_vat' => $request->rate_vat,
            'value_vate' => $request->value_vate,
            'total' => $request->total,
            'status' => $request->status,
            'note' => $request->note,
            'user' => Auth::user()->name,
        ]);
        DB::table('invoices_details')->where('invoice_id', $invoice->id)
            ->update([
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section_id,
                'status' => $request->status,
                'payment_Date' => $request->Payment_Date,
                'note' => $request->note,
                'user' => Auth::user()->name,
            ]);
        Storage::disk('public_uploads')->move($invoice->invoice_number . '/' . $current_file_name->file_name, $request->invoice_number . '/' . $current_file_name->file_name);

        DB::table('invoice_attachments')->where('invoice_id', $invoice->id)
            ->update([
                'invoice_number' => $request->invoice_number,
            ]);
        $users = User::get();

        Notification::send($users, new InvoiceUpdate($invoice->id, $invoice->invoice_number));
        return redirect()->route('invoices.index')->with('success_update', 'تم تعديل الفاتوره بنجاح ');
    }


    public function paidInvoices()
    {
        $paidInvoices = Invoice::where('status', '=', '1')->get();
        return view('invoices.paid', compact('paidInvoices'));
    }
    public function unPaidInvoices()
    {
        $unPaidInvoices = Invoice::where('status', '=', '2')->get();
        return view('invoices.unpaid', compact('unPaidInvoices'));
    }
    public function partialInvoices()
    {
        $PartialInvoices = Invoice::where('status', '=', '3')->get();
        return view('invoices.partial', compact('PartialInvoices'));
    }
    public function printInvoices(Invoice $invoice)
    {
        return view('invoices.print', compact('invoice'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Invoice $invoice)
    {
        if ($request->archieve_invoice) {
            if ($invoice->status == 1) {
                $invoice->delete();
                return redirect()->route('invoices.index')->with('success_archieve', 'تم ارشفه الفاتوره بنجاح');
            } else {
                return redirect()->route('invoices.index')->with('failed_archieve',  'يجب ان تكون الفاتوره مدفوعه لكى تنقل للارشيف');
            }
        }
        $file_name = DB::table('invoice_attachments')->where('invoice_id', $invoice->id)->select('file_name')->first();
        $invoice->forceDelete();
        Storage::disk('public_uploads')->deleteDirectory('/' . $invoice->invoice_number);
        $users = User::get();
        Notification::send($users, new InvoiceDelete($invoice->id, $invoice->invoice_number));
        return redirect()->route('invoices.index')->with('success_delete', 'تم حذف الفاتوره بنجاح');
    }
    public function export()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }
    public function exportPaidInvoices()
    {
        return Excel::download(new InvoicesPaidExport, 'PaidInvoices.xlsx');
    }
    public function exportUnPaidInvoices()
    {
        return Excel::download(new InvoicesUnPaidsExport, 'UnPaidInvoices.xlsx');
    }
    public function exportArchievedInvoices()
    {
        return Excel::download(new ArchievedInvoicesExport, 'ArchievedInvoices.xlsx');
    }

    public function markAsReadAll()
    {
        auth()->user()->unReadNotifications();
    }
}
