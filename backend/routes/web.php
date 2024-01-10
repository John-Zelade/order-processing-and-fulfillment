<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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
    return view('welcome');
});

/**********************************View admin pages********************************************/
Route::get('admin/orders', [OrderController::class, 'Orders'])->name('admin.orders');

Route::get('/admin/order/{id}/update-status',[OrderController::class,'EditStatus']);
Route::post('update', [OrderController::class, 'UpdateStatus'])->name('updateStatus');
