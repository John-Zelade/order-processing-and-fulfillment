<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;
use App\Models\order_items;
use App\Models\customer;
use Illuminate\Support\Facades\File; // Add this line

class OrderController extends Controller
{
/*****************************************************API ROUTES******************************************************/
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
/********************************Display Orders*******************************
    function Orders(){
        $order=order::all();
        return response()->json([
            'status_code'=>200,
            'order'=>$order
      ]);
    }
*/

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

/*****************************Cancel Order*************************************
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
    }*/

/**********************Update Status Of Order Items***************************
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
    }*/


/*
|--------------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------------
|
*/
/***********************************ADMIN**************************************/

/********************************Display Orders********************************/
function Orders(){
    $orders=order::all();

    return view('admin.orders', ['orders' => $orders]);
}
/**********************Edit Status Of Order Items****************************/
    function  EditStatus($id){
        $order= order_items::join('orders', 'order_items.OrderID', '=', 'orders.id')
        ->join('customers', 'orders.CustomerID', '=', 'customers.id')
        ->join('products', 'order_items.ProductID', '=', 'products.id')
        ->select('order_items.id','orders.id AS orderID', 'order_items.Qty', 'order_items.UnitPrice', 'orders.OrderNo', 'customers.name', 'orders.Status', 'orders.OrderDate', 'orders.ShippedAddress', 'orders.OrderTotal',
                  'products.item')
        ->where('order_items.OrderID', $id)
        ->first();
        return view('admin.update-status',['StatusOrder'=>$order]);
    }

/**********************Update Status Of Order Items****************************/
    function UpdateStatus(Request $request){
        $order = order::find($request->id);
        $order->Status = $request->status; // Use 'status' instead of 'Status'
        
        echo '<script>alert("' . htmlspecialchars($request->id) . '")</script>';
        $order->save();
        return redirect('admin/orders');
}
/******************************************************************************* */
    function  updateOrderStatus(){
        $id=2;
        $order = order::join('customers', 'orders.CustomerID', '=', 'customers.id')
        ->select('orders.Status','customers.id AS CustomerID')
        ->where('orders.id', $id)
        ->get();

        $orderItems = [];
        foreach ($order as $order) {
            $orderItems[] = [
                'status' => $order->Status,
                'customer_id' => $order->CustomerID,
            ];
        }
        
            return response()->json([
                //'customer'=> $customer,
                'order items' => $orderItems[0]['customer_id'],
            ]);
        
    }


/***********************************CUSTOMER**************************************/
  /****************************Display To Pay orders******************************/
    function  pendingOrders( $customerID){
        //$customerID=1;
        $customer = customer::find($customerID);

        $orderItem= order_items::join('orders', 'order_items.OrderID', '=', 'orders.id')
        ->join('customers', 'orders.CustomerID', '=', 'customers.id')
        ->join('products', 'order_items.ProductID', '=', 'products.id')
        ->select('order_items.id', 'order_items.Qty', 'order_items.UnitPrice','orders.id as OrderID', 'orders.OrderNo', 'customers.name', 'orders.Status', 'orders.OrderDate', 'orders.ShippedAddress', 'orders.OrderTotal',
                  'products.item')
        ->where('customers.id', $customerID)
        ->where('orders.Status', 'Pending')
        ->get();

        
        //echo '<script>alert("' . htmlspecialchars($orderItem) . '")</script>';
        return view('customer.to-pay',['orderItem'=>$orderItem, 'customerID' => $customerID]);
    }
    
  /****************************Cancel orders******************************/
    function  cancelOrder(Request $request){
        //$order = order::find($request->id);
         // Find the order with the associated customer
        $order = order::join('customers', 'orders.CustomerID', '=', 'customers.id')
        ->select('orders.*', 'customers.id AS CustomerID')
        ->where('orders.id', $request->id)
        ->first();

         // Update the order status to "Cancelled"
        $order->update(['Status' => 'Cancelled']);

        // Redirect to the cancelled orders page
        return redirect()->route('customer.getCancelOrder', ['id' => $order->CustomerID]);
    }

     /****************************Cancel orders******************************/
     function  getCancelOrder($customerID){
        $customer = customer::find($customerID);

        $orderItem= order_items::join('orders', 'order_items.OrderID', '=', 'orders.id')
        ->join('customers', 'orders.CustomerID', '=', 'customers.id')
        ->join('products', 'order_items.ProductID', '=', 'products.id')
        ->select('order_items.id', 'order_items.Qty', 'order_items.UnitPrice', 'orders.OrderNo', 'customers.name', 'orders.Status', 'orders.OrderDate', 'orders.ShippedAddress', 'orders.OrderTotal',
                  'products.item')
        ->where('customers.id', $customerID)
        ->where('orders.Status', 'Cancelled')
        ->get();

        return view('customer.cancellations',['orderItem'=>$orderItem, 'customerID' => $customerID]);
    }
    /****************************Display To Pay orders******************************/
    function  ordersToShip($customerID){
        $customer = customer::find($customerID);

        $orderItem= order_items::join('orders', 'order_items.OrderID', '=', 'orders.id')
        ->join('customers', 'orders.CustomerID', '=', 'customers.id')
        ->join('products', 'order_items.ProductID', '=', 'products.id')
        ->select('order_items.id', 'order_items.Qty', 'order_items.UnitPrice','orders.id as OrderID', 'orders.OrderNo', 'customers.name', 'orders.Status', 'orders.OrderDate', 'orders.ShippedAddress', 'orders.OrderTotal',
                  'products.item')
        ->where('customers.id', $customerID)
        ->where('orders.Status', 'Picking/Packed')
        ->get();

        
        return view('customer.to-ship',['orderItem'=>$orderItem, 'customerID' => $customerID]);
    }
    /****************************Display To Pay orders******************************/
    function  ordersToReceive($customerID){
        $customer = customer::find($customerID);

        $orderItem= order_items::join('orders', 'order_items.OrderID', '=', 'orders.id')
        ->join('customers', 'orders.CustomerID', '=', 'customers.id')
        ->join('products', 'order_items.ProductID', '=', 'products.id')
        ->select('order_items.id', 'order_items.Qty', 'order_items.UnitPrice','orders.id as OrderID', 'orders.OrderNo', 'customers.name', 'orders.Status', 'orders.OrderDate', 'orders.ShippedAddress', 'orders.OrderTotal',
                  'products.item')
        ->where('customers.id', $customerID)
        ->where('orders.Status', 'Shipped')
        ->get();

        return view('customer.to-receive',['orderItem'=>$orderItem, 'customerID' => $customerID]);
    }

    /****************************Display To Pay orders******************************/
    function orderReceived(Request $request){
        $order = order::join('customers', 'orders.CustomerID', '=', 'customers.id')
        ->select('orders.*', 'customers.id AS CustomerID')
        ->where('orders.id', $request->id)
        ->first();

         // Update the order status to "Cancelled"
        $order->update(['Status' => 'Delivered']);

        // Redirect to the cancelled orders page
        return redirect()->route('customer.receivedOrders', ['id' => $order->CustomerID]);
    }
    /****************************Display To Pay orders******************************/
    function  receivedOrders($customerID){
        $customer = customer::find($customerID);

        $orderItem= order_items::join('orders', 'order_items.OrderID', '=', 'orders.id')
        ->join('customers', 'orders.CustomerID', '=', 'customers.id')
        ->join('products', 'order_items.ProductID', '=', 'products.id')
        ->select('order_items.id', 'order_items.Qty', 'order_items.UnitPrice','orders.id as OrderID', 'orders.OrderNo', 'customers.name', 'orders.Status', 'orders.OrderDate', 'orders.ShippedAddress', 'orders.OrderTotal',
                  'products.item')
        ->where('customers.id', $customerID)
        ->where('orders.Status', 'Delivered')
        ->get();

        return view('customer.received',['orderItem'=>$orderItem, 'customerID' => $customerID]);
    }
    
    }

