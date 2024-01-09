<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;
use App\Models\order_items;
use App\Models\customer;

class OrderController extends Controller
{
/*********************************Place Order**********************************/
    function placeOrder(Request $request){
        $order=order::create([
            'OrderNo'=>$request->OrderNo,
            'CustomerID'=>$request->CustomerID,
            'Status'=>$request->Status,
            'OrderDate'=>$request->OrderDate,
            'ShippedAddress'=>$request->ShippedAddress,
            'OrderTotal'=>$request->OrderTotal
        ]);
        $orderItem=order_items::create([
            'OrderID'=> $order->id,
            'ProductID'=>$request->ProductID,
            'UnitPrice'=>$request->UnitPrice,
            'Qty'=>$request->Qty
        ]);
        return response()->json([
            'Order Item'=> $orderItem,
            'Order'=>$order
        ]);
    }

/********************************Display Orders********************************/
    function Orders(){
        $order=order::all();
        return response()->json([
            'status_code'=>200,
            'order'=>$order
      ]);
    }

/**********************Display Order Items****************************/
    function  orderItems(){
        $order_items=order_items::all();
        return response()->json([
            'status_code'=>200,
            'order'=>$order_items
      ]);
    }


/**********************Display Cutomer Order Details****************************/
    function orderDetails($id){
        try {
            // Retrieve the customer and their orders
            $customer = customer::with(['orders.orderItems'])->find($id);
            
             // Extract order items from the customer
             $orderItems = $customer->orders->flatMap(function ($order) {
                return $order->orderItems;
            });
        
            return response()->json([
                'customer' => $customer,
                'orderItems' =>$orderItems 
                //'orders' => $customer->orders,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }

/*****************************Cancel Order**************************************/
    function cancelOrder(Request $request, $id){
        $orderItem= order_items::join('orders', 'order_items.OrderID', '=', 'orders.id')
        ->join('customers', 'orders.CustomerID', '=', 'customers.id')
        ->join('products', 'order_items.ProductID', '=', 'products.id')
        ->select('order_items.id', 'order_items.Qty', 'order_items.UnitPrice', 'orders.OrderNo', 'customers.name', 'orders.Status', 'orders.OrderDate', 'orders.ShippedAddress', 'orders.OrderTotal',
                  'products.item')
        ->where('order_items.id', $id)
        ->first();
        if($orderItem){
            $orderItem->Status = $request->Status;
            return response()->json([
                'order item'=>$orderItem,
                'message'=>"Order cancelled"
            ]);
        }else{
            return response()->json([
                'order'=>"Order Not Found",
            ]);
        }
    }

/**********************Update Status Of Order Items****************************/
    function  updateStatus(Request $request, $id){
        $order=order::find($id);
           // Validate the request data based on your requirements
           $request->validate([
            'status' => 'required|in:Pending,Processing,Shipped,Delivered,Cancelled',
        ]);
        if($order){
            $order->Status = $request->Status;
            $order->update();
            return response()->json([
                'status_code'=>200,
                'order item'=>$order,
                'message'=>"Status Updated"
            ]);
        }else{
            return response()->json([
                'order'=>"Order Not Found",
            ]);
        }
    }
}
