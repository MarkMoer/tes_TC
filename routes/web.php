<?php

use App\Http\Controllers\TransactionController;
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
//     return view('transactions.index');
// });
Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/transactions/{transaction}/items', [TransactionController::class, 'viewItems'])->name('transactions.view_items');
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
Route::get('/transactions/{transaction}/edit-all-items', [TransactionController::class, 'editAllItems'])->name('transactions.edit_all_items');
Route::delete('/transactions/{transaction}/delete-item/{item}', [TransactionController::class, 'deleteItem'])->name('transactions.delete_item');
Route::put('/transactions/{transaction}/update-all-items', [TransactionController::class, 'updateAllItems'])->name('transactions.update_all_items');
Route::get('/transactions/{transaction}/delete', [TransactionController::class, 'delete'])->name('transactions.delete');
Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
