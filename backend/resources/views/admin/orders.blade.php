<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
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
    </div>
    <div class="orders-container">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Order no.</th>
                                <th>Status</th>
                                <th>Order Total</th>
                                <th>View</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                        <tr >
                            <td>{{$order->id}}</td>
                            <td>{{$order->CustomerID}}</td>
                            <td>{{$order->OrderNo}}</td>
                            <td>{{$order->Status}}</td>
                            <td>{{$order->OrderTotal}}</td>
                            <td>
                                <div class="view-btn-con">
                                    <button class="view-btn"><a href="/admin/order/{{$order->id}}/update-status">View Order</a></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
       
    </div>
</body>
</html>