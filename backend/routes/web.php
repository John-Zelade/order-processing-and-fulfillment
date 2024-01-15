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
/**********************************View customer pages********************************************/
Route::get('/customer/to-pay/{id}/orders',[OrderController::class,'pendingOrders'])->name('customer.pendingOrders');
Route::get('/customer/to-ship/{id}/orders',[OrderController::class,'ordersToShip'])->name('customer.ordersToShip');
Route::get('/customer/to-receive/{id}/orders',[OrderController::class,'ordersToReceive'])->name('customer.ordersToReceive');
Route::get('/customer/received/{id}/orders',[OrderController::class,'receivedOrders'])->name('customer.receivedOrders');
Route::get('/customer/cancelled/{id}/order', [OrderController::class, 'getCancelOrder'])->name('customer.getCancelOrder');
Route::post('cancelled/order', [OrderController::class, 'cancelOrder'])->name('cancelOrder');
Route::post('received/order', [OrderController::class, 'orderReceived'])->name('orderReceived');

/**********************************View admin pages********************************************/
Route::get('admin/orders', [OrderController::class, 'Orders'])->name('admin.orders');
Route::get('/admin/order/{id}/update-status',[OrderController::class,'EditStatus']);
Route::post('update', [OrderController::class, 'UpdateStatus'])->name('updateStatus');
