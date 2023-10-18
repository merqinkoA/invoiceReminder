<?php

use App\Http\Controllers\InvoiceReminderController;
use App\Http\Controllers\dueDateController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

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


Route::resource('invoiceReminder', InvoiceReminderController::class)->middleware('auth');
Route::resource('vendor', VendorController::class)->middleware('auth');
Route::delete('/invoiceReminder/{pr_number}', [InvoiceReminderController::class, 'destroy'])->name('invoiceReminder.destroy');
Route::post('/invoice-reminder/send-email/{pr_number}', [InvoiceReminderController::class, 'sendEmail'])->name('invoiceReminder.sendEmail');


Route::resource('dueDate', dueDateController::class)->middleware('auth');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/invoiceReminder', [InvoiceReminderController::class, 'index'])->name('invoiceReminder.index');
// Route::get('/invoiceReminder/create', [InvoiceReminderController::class, 'create'])->name('invoiceReminder.create');
// Route::post('/invoiceReminder', [InvoiceReminderController::class, 'store'])->name('invoiceReminder.store');
// Route::get('/invoiceReminder/{pr_number}', [InvoiceReminderController::class, 'show'])->name('invoiceReminder.show');
// Route::get('/invoiceReminder/{pr_number}/edit', [InvoiceReminderController::class, 'edit'])->name('invoiceReminder.edit');
// Route::put('/invoiceReminder/{pr_number}', [InvoiceReminderController::class, 'update'])->name('invoiceReminder.update');
// Route::delete('/invoiceReminder/{pr_number}', [InvoiceReminderController::class, 'destroy'])->name('invoiceReminder.destroy');
