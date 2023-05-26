<?php

use App\Models\Invoices_details;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadImage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UIController\HomeController;
use App\Http\Controllers\UIController\RoleController;
use App\Http\Controllers\UIController\InvoiceController;
use App\Http\Controllers\UIController\ProductController;
use App\Http\Controllers\UIController\SectionController;
use App\Http\Controllers\UIController\InvoiceReportController;
use App\Http\Controllers\UIController\CustomersReportController;
use App\Http\Controllers\UIController\InvoiceArchieveController;
use App\Http\Controllers\UIController\InvoicesDetailsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function () {
    return view('auth.login');
});

// Auth::routes();
Auth::routes(['register' => false]);
// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware(['Lang','CheckUserStatus'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    Route::resource('/invoices', InvoiceController::class);
    Route::resource('/invoicesDetails', InvoicesDetailsController::class);
    Route::resource('/sections', SectionController::class);
    Route::resource('/products', ProductController::class);
    Route::resource("/archieve", InvoiceArchieveController::class);
    




    Route::controller(InvoiceController::class)->group(function () {
        Route::get("/section/{id}", 'getProducts')->name('invoices.getProducts');
        Route::get("/paid", 'paidInvoices')->name('invoices.paid');
        Route::get("/unPaid", 'unPaidInvoices')->name('invoices.unPaid');
        Route::get("/partial", 'partialInvoices')->name('invoices.partial');
        Route::get('allInvoices/export', 'export')->name('invoices.export');
        Route::get('InvoicesPaid/export', 'exportPaidInvoices')->name('invoicesPaid.export');
        Route::get('InvoicesUnPaid/export', 'exportUnPaidInvoices')->name('invoicesUnPaid.export');
        Route::get('InvoicesArchieved/export', 'exportArchievedInvoices')->name('invoicesArchieved.export');
        Route::get('marksAllRead',  'markAsReadAll')->name('notifications.markAllread');
        Route::get("/archeive/print/{invoice}", 'printInvoices')->name('invoices.print');
        Route::patch("invoices/addAttachment/{id}", 'addAttachment')->name('invoices.addAttachment');
        Route::post("invoices/update_status/{invoice}", 'statusUpdate')->name('invoices.statusUpdate');
    });
    
    Route::controller(InvoicesDetailsController::class)->group(function () {
        Route::get('/get_file/{id}/{invoice_number}', 'get_file')->name('invoice.get_file');
        Route::get('/download_file/{id}/{invoice_number}', 'download_file')->name('invoice.download_file');
    });
    
    Route::controller(InvoiceReportController::class)->group(function () {
        Route::get('/invoicesReport', 'index')->name('reports.invoices');
        Route::post('/invoicesSearch', 'invoicesSearch')->name('reportsInvoices.search');
    });
    
    Route::group(['middleware' => ['auth']], function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
    });
    Route::controller(CustomersReportController::class)->group(function () {
        Route::get('/CustomersReport', 'index')->name('reports.Customers');
        Route::post('/CustomersSearch', 'reportsSearch')->name('reportsCustomers.search');
    });
    
    Route::get("/archeive/restore/{id}", [InvoiceArchieveController::class, 'restore'])->name('archieve.restore');
    
});

Route::get("/{index}", [AdminController::class, 'index']);
Route::get('/lang/{lang}',[LanguageController::class,'changeLanguage'])->name('lang.change');

Route::get('/{page}',function($page){
    return view('page');
});