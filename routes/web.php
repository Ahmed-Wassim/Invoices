<?php

use App\Models\invoices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceReportController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\InvoicesArchiveController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Middleware\CheckStatus;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', InvoicesController::class);

Route::resource('sections', SectionsController::class);

Route::resource('products', ProductsController::class);

Route::get('section/{id}', [InvoicesController::class, 'getproducts']);

Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class, 'edit']);

Route::get('/edit_invoice/{id}', [InvoicesController::class, 'edit']);

Route::get('/Status_show/{id}', [InvoicesController::class, 'show'])->name('Status_show');

Route::post('/Status_Update/{id}', [InvoicesController::class, 'Status_Update'])->name('Status_Update');

Route::get('PaidInvoices', [InvoicesController::class, 'paidInvoices']);

Route::get('UnpaidInvoices', [InvoicesController::class, 'unpaidInvoices']);

Route::get('PartialInvoices', [InvoicesController::class, 'partialInvoices']);

Route::resource('Archive', InvoicesArchiveController::class);

Route::get('Print_invoice/{id}', [InvoicesController::class, 'PrintInvoice']);

Route::get('export_invoices', [InvoicesController::class, 'export']);

Route::post('delete_file', [InvoicesDetailsController::class, 'destroy'])->name('delete_file');

Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'get_file']);

Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file']);

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('invoice_report', [InvoiceReportController::class, 'index']);

Route::post('Search_invoices', [InvoiceReportController::class, 'search']);

Route::get('MarkAsRead_all', [InvoicesController::class, 'MarkAsRead_all'])->name('MarkAsRead_all');

Route::get('/{page}', [AdminController::class, 'index']);
