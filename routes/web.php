<?php

use App\Http\Controllers\InvoiceReminderController;
use App\Http\Controllers\dueDateController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\PicController;
use Illuminate\Support\Facades\Route;
use App\Models\invoice_reminder;
use Carbon\Carbon;
use App\Models\Vendor;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
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

// Route::get('/', function () {
//     return view('auth.login');
// });

Auth::routes();

// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/', function () {
//     $now = Carbon::now();
//     $timezone = Config::get('app.timezone');
//     $vendors = Vendor::all();
//     $invoice_reminders = Invoice_Reminder::all();
//     // return view('layouts.invoiceReminder.index', compact('invoice_reminders','timezone','vendors'));
//     return view('layouts.invoiceReminder.index',  compact('invoice_reminders','timezone','vendors'));
// });


Route::group(['middleware' => 'auth'], function () {
    Route::resource('invoiceReminder', InvoiceReminderController::class)->middleware('auth');
    Route::get('/apiInvoiceReminder', [InvoiceReminderController::class, 'apiInvoiceReminder'])->name('api.invoice');
});
// Route::post('/invoiceReminder/passData', 'InvoiceReminderController@passData');

Route::get('/get-vendor-emails', [VendorController::class, 'getVendorEmails'])->name('getVendorEmails');


Route::group(['middleware' => 'auth'], function () {
    Route::resource('vendor', VendorController::class)->middleware('auth');
    // Route::resource('vendor', 'VendorController');
    Route::get('/apiVendor', [VendorController::class, 'apiVendor'])->name('api.vendor');
    // Route::get('/apiVendor', 'VendorController@apiVendor')->name('api.vendor');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('pic', PicController::class)->middleware('auth');
    // Route::resource('vendor', 'VendorController');
    Route::get('/apiPic', [PicController::class, 'apiPic'])->name('api.pic');
    Route::get('/get-pic-emails',  [PicController::class, 'getPICEmails'])->name('get.pic.emails');

    // Route::get('/apiVendor', 'VendorController@apiVendor')->name('api.vendor');
});
// Route::delete('/invoiceReminder/{pr_number}', [InvoiceReminderController::class, 'destroy'])->name('invoiceReminder.destroy');
// Route::post('/invoice-reminder/send-email/{pr_number}', [InvoiceReminderController::class, 'sendEmail'])->name('invoiceReminder.sendEmail');


Route::resource('dueDate', dueDateController::class)->middleware('auth');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/invoiceReminder', [InvoiceReminderController::class, 'index'])->name('invoiceReminder.index');
// Route::get('/invoiceReminder/create', [InvoiceReminderController::class, 'create'])->name('invoiceReminder.create');
// Route::post('/invoiceReminder', [InvoiceReminderController::class, 'store'])->name('invoiceReminder.store');
// Route::get('/invoiceReminder/{pr_number}', [InvoiceReminderController::class, 'show'])->name('invoiceReminder.show');
// Route::get('/invoiceReminder/{pr_number}/edit', [InvoiceReminderController::class, 'edit'])->name('invoiceReminder.edit');
// Route::put('/invoiceReminder/{pr_number}', [InvoiceReminderController::class, 'update'])->name('invoiceReminder.update');
// Route::delete('/invoiceReminder/{pr_number}', [InvoiceReminderController::class, 'destroy'])->name('invoiceReminder.destroy');
