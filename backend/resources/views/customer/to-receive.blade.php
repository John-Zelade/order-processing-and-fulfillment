<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
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
            <div>WAVE</div>
        </div>
        <div class="status-container">
            <div><a href="{{ route('customer.pendingOrders') }}">To Pay    </a></div>
            <div><a href="{{ route('customer.ordersToShip') }}">To Ship   </a></div>
            <div><a href="{{ route('customer.ordersToReceive') }}">To Recieve</a></div>
            <div><a href="{{ route('customer.receivedOrders') }}">Recieved   </a></div>
            <div><a href="{{ route('customer.getCancelOrder') }}">Cancellations</a></div>
        </div>
    </div>
    <div class="orders-container">
            <div class="status">
                <div>To Receive</div>
                <div class="span-container">
                    <span>We will be packing your parcel soon!</span>
                    <span></span>
                    <div>
                        <i class="fa-solid fa-truck"></i>
                        <span>Seller will prepare and ship your package by Dec 13.</span>
                    </div>
                    
                    <div>
                        <i class="fa-solid fa-map-location-dot"></i>
                        <div>
                        <span><strong>Thirdy Rubio </strong> </br>
                        Blk.3 Lot.8 example address, example address, Camarin</br>
                        Caloocan City, Metro Manila-Caloocan, Caloocan</br>
                        City, Baranggay 666</br>
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
                            <td>WAVE Thumbler - 500ML</td>
                            <td>499</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>WAVE Thumbler - 500ML</td>
                            <td>499</td>
                            <td>1</td>
                        </tr>
                    </table>
                </div>

                <div>
                    <div class="total-prc">Total Price:</div>
                    <div>
                        <div>Paid by</div>
                         <span>Cash on Delivery</span>
                    </div>
                    <div>
                        <div>Order no.</div>
                        <span>############</span>
                    </div>
                </div>
            </div>
    </div>
</body>
</html>