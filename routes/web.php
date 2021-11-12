<?php

use App\Http\Controllers\Admin\HostController;
use App\Http\Controllers\Admin\MiscellaneousController;
use App\Http\Controllers\Codebooks\Associates\AssociateController;
use App\Http\Controllers\Codebooks\CityController;
use App\Http\Controllers\CodeBooks\Products\ProductController;
use App\Http\Controllers\Codebooks\StateController;
use App\Http\Controllers\Invoices\InvoicesController;
use App\Http\Controllers\Invoices\InvoicesDetailController;
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
    // Admin
    Route::get('create-host', [HostController::class, 'create'])->name('create.host');
    Route::post('store-host', [HostController::class, 'store'])->name('store.host');
    Route::post('files/destroy', [MiscellaneousController::class, 'removeTemporaryImage']);

    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('show.users');
    Route::get('users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit.user');
    Route::post('users/{id}/update', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('update.user');
    Route::post('users/{id}/store', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('store.user');
    Route::delete('users/{id}/delete', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('delete.user');
    // Invoices
//    Route::resource('invoices', InvoicesController::class);
    Route::get('invoices', [InvoicesController::class, 'index'])->name('invoices.index');
    Route::get('invoices/{id}/show', [InvoicesController::class, 'show'])->name('invoices.show');
    Route::get('invoices/{id}/edit', [InvoicesController::class, 'edit'])->name('invoices.edit');
    Route::get('invoices/create', [InvoicesController::class, 'create'])->name('invoices.create');
    Route::post('invoices/{id}', [InvoicesController::class, 'update'])->name('invoices.update');
    Route::post('invoices', [InvoicesController::class, 'store'])->name('invoices.store');
    Route::delete('invoices/{id}/destroy', [InvoicesController::class, 'destroy'])->name('invoices.destroy');
    //Invoice Items
    Route::resource('invoices-details', InvoicesDetailController::class);
    Route::delete('invoice/item/{id}/delete', [InvoicesDetailController::class, 'destroy'])->name('invoice.delete.item');
    Route::post('invoice/item/action', [InvoicesDetailController::class, 'action'])->name('invoice.item.action');

    Route::get('invoices/{invoice_id}/download', [InvoicesController::class, 'download'])->name('invoices.download');

    // Codebooks
    Route::resource('products', ProductController::class);
    Route::resource('associates', AssociateController::class);
    Route::get('cities', [CityController::class, 'index'])->name('cities.index');
    Route::get('states', [StateController::class, 'index'])->name('states.index');

});
