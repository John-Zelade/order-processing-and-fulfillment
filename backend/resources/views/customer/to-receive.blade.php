<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="{{ asset('js_navbar/bootstrap.bundle.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css_navbar/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css_navbar/Navbar.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
    <title>Wave</title>
    </head>
<body>
    <div class="header">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="/pics/Logo.png" alt="logo"
                    style="height: 10vh; width: auto;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">PRODUCTS</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            CONTACT
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">FAQ</a></li>
                            <hr class="dropdown-divider">
                            <li><a class="dropdown-item" href="#">CONTACT INFORMATION</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active">ABOUT</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-but">
                        <a class="btn btn-outline-light" href="ShoppingCart.html">
                            <!-- Adjusted size of the cart icon -->
                            <i class="bi bi-cart" style="font-size: 1rem;"></i>
                        </a>
                    </li>
                    <li class="nav-but">
                        <a class="btn btn-outline-light" href="#">Signup</a>
                    </li>
                    <li class="nav-but">
                        <!-- Set the background color of the "Login" button to #1277aa -->
                        <a class="btn text-white" style="background-color: #1277aa;" href="#">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
<form class="orders-container" action="{{ route('orderReceived') }}" method="POST">
    @csrf  <!-- @csrf is a token to submit form -->
    <input type="hidden" name="id" value="{{$orderItem->OrderID}}">
            <div class="status">
                <div>To Receive</div>
                <div class="span-container">
                    <span>We will deliver your parcel soon!</span>
                    <span></span>
                    <div>
                        <i class="fa-solid fa-truck"></i>
                        <span>Seller will prepare and deliver your package..</span>
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
                            <td>{{$orderItem->Qty}}</td>
                        </tr>
                    </table>
                </div>

                <div>
                    <div class="total-prc">Total Price:  {{$orderItem->UnitPrice * $orderItem->Qty}}</div>
                    <div>
                        <div>Paid by</div>
                         <span>Cash on Delivery</span>
                    </div>
                    <div>
                        <div>Order no.</div>
                        <span>{{$orderItem->OrderNo}}</span>
                    </div>
                    <div class="cancel-btn-con">
                        <button class="cancel-btn" type="submit">Order Received</button>
                    </div>
                </div>
            </div>
        </form>
    @endforeach
@endif
</body>
</html>