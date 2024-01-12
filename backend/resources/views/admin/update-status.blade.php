<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/update-status.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
<title>Wave</title>
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <div>
                <div><img src="{{ asset('css/img/wave-logo.png') }}" alt=""></div>
                <div>WAVE</div>
            </div>
            <div>
                <div class="back-btn">
                    <a href="{{ route('admin.orders') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
<form class="orders-container" action="{{ route('updateStatus') }}" method="POST">
@csrf  <!-- @csrf is a token to submit form -->
      <input type="hidden" name="id" value="{{$StatusOrder->id}}">
        <div class="status">
            <div>Delivery Details</div>
            <div class="details-container">
                <div>
                   <span> Name</span>
                   <span>{{$StatusOrder->name}}</span>
                </div>
                <div>
                    <span> Email</span>
                    <span>user@gmail.com</span>
                    
                </div>
                <div>
                    <span> Phone</span>
                    <span>09234567893</span>
                 
                </div>
                <div>
                    <span> Order No.</span>
                    <span>{{$StatusOrder->OrderNo}}</span>
                </div>   
                <div>
                   <span> Address</span>
                   <span>{{$StatusOrder->ShippedAddress}}</span>
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
                        <td>{{$StatusOrder->item}}</td>
                        <td>{{$StatusOrder->UnitPrice}}</td>
                        <td>{{$StatusOrder->Qty}}</td>
                    </tr>
                </table>
            </div>

            <div>
                <div class="total-prc">
                    Total Price:
                    <span>{{$StatusOrder->UnitPrice * $StatusOrder->Qty}}</span>
                </div>
                <div>
                    <div>Paid by</div>
                     <span>Cash on Delivery</span>
                </div>
                <div>
                    <div>Status</div>
                <select id="statusDropdown" name="status">
                    <option value="Pending" {{ $StatusOrder->Status == 'Pending' ? 'selected' : '' }}>To Pay</option>
                    <option value="Picking/Packed" {{ $StatusOrder->Status == 'Picking/Packed' ? 'selected' : '' }}>To Ship</option>
                    <option value="Shipped" {{ $StatusOrder->Status == 'Shipped' ? 'selected' : '' }}>To Receive</option>
                    <option value="Delivered" {{ $StatusOrder->Status == 'Delivered' ? 'selected' : '' }}>Received</option>
                </select>
                </div>
                <div class="cancel-btn-con">
                    <button class="cancel-btn" type="submit">Update Status</button>
                </div>
            </div>
    </div>
</form>
</body>
</html>