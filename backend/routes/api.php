<?php
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/***********************************Cusomter API***********************************/
Route::post('orders/place', [OrderController::class, 'placeOrder']);
Route::get('customer/{id}/orders', [OrderController::class, 'orderDetails']);
Route::put('orders/{id}/cancel', [OrderController::class, 'cancelOrder']);

/***********************************Admin API***********************************/
Route::get('orders/', [OrderController::class, 'Orders']);
Route::get('order-items/', [OrderController::class, 'orderItems']);
Route::put('orders/{id}/update-status', [OrderController::class, 'updateOrderStatus']);
