<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
<title>Wave</title>
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <div><img src="{{ asset('css/img/wave-logo.png') }}" alt=""></div>
            <div class="nav">
            <div>WAVE</div>
            <div class="nav-links" id="navLinks">
				<ul>
					<li> <a href="#">HOME</a></li>
					<li> <a href="#">PRODUCTS</a></li>
					<li> <a href="#">CONTACT</a></li>
					<li> <a href="#">ABOUT</a></li>
				</ul>
			</div>
            </div>
        </div>
        <div class="status-container">
            <div> <a href="{{ route('customer.pendingOrders',  ['id' => $customerID]) }}">To Pay</a></div>
            <div><a href="{{ route('customer.ordersToShip', ['id' => $customerID]) }}">To Ship   </a></div>
            <div><a href="{{ route('customer.ordersToReceive', ['id' => $customerID]) }}">To Recieve</a></div>
            <div><a href="{{ route('customer.receivedOrders', ['id' => $customerID]) }}">Recieved   </a></div>
            <div><a href="{{ route('customer.getCancelOrder',  ['id' => $customerID]) }}">Cancellations</a></div>
        </div>
    </div>
@if($orderItem->isEmpty())
<!--<p>No order items found. Continue shopping <a href="">here</a>.</p>-->
<p>No order items found. Continue shopping <a href="">here</a>.</p>
@else
@foreach($orderItem as $orderItem)
    <form class="orders-container" action="{{ route('cancelOrder') }}" method="POST">
@csrf  <!-- @csrf is a token to submit form -->
<input type="hidden" name="id" value="{{$orderItem->OrderID}}">
            <div class="status">
                <div>Seller to Pack</div>
                <div class="span-container">
                    <span>We will be packing your parcel soon!</span>
                    <span></span>
                    <div>
                        <i class="fa-solid fa-truck"></i>
                        <span>Seller will prepare and ship your package by Dec 13.</span>
                    </div>
                    
                    <div>
                        <i class="fa-solid fa-map-location-dot"></i>
                        <div class="customer-info-pending">
                        <span><strong>{{$orderItem->name}} </strong> </br>
                        {{$orderItem->ShippedAddress}}
                        </span>
                        </div>
                    </div>      
                </div>
            </div>

            <div class="order-detail">
                <div>Order Details</div>
                <div>
                    <table>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        <tr>
                            <td>{{$orderItem->item}} </td>
                            <td>{{$orderItem->UnitPrice}} </td>
                            <td>{{$orderItem->Qty}} </td>
                        </tr>
                    </table>
                </div>

                <div>
                    <div class="total-prc">Total Price: {{$orderItem->UnitPrice * $orderItem->Qty}} </div>
                    <div>
                        <div>Paid by</div>
                         <span>Cash on Delivery</span>
                    </div>
                    <div>
                        <div>Order no.</div>
                        <span>{{$orderItem->OrderNo}} </span>
                    </div>
                    <div class="cancel-btn-con">
                        <button class="cancel-btn" type='submit'>Cancel Order</button>
                    </div>
                </div>
            </div>
</form>
@endforeach
@endif
</body>
</html>