<?php

use App\Http\Controllers\Codebooks\Associates\AssociateController;
use App\Http\Controllers\CodeBooks\Products\ProductController;
use App\Http\Controllers\Invoices\InvoicesController;
use App\Http\Controllers\Invoices\InvoicesDetailController;
use App\Http\Controllers\TestController;
use App\Models\Codebooks\Associate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    // Invoices
    Route::resource('invoices', InvoicesController::class);
    Route::get('invoices/{invoice_id}/download', [InvoicesController::class, 'download'])->name('invoices.download');
    Route::resource('invoices-details', InvoicesDetailController::class);

    // Codebooks
    Route::resource('products', ProductController::class);
    Route::resource('associates', AssociateController::class);

    // Test
    Route::get('test', [TestController::class, 'test']);
    Route::post('test.index', [TestController::class, 'index'])->name('test.index');
});
