<html lang="en-US">
<head>
    <meta charset="text/html">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div>

    <div class="jumbotron text-center">
        <img src="http://test.shop/images/logo/logo-transparent.png" alt="MMOZONE Games">
        <h1 class="display-4 my-5">Thank You!</h1>
        <div class="card col-md-6 offset-md-3">
            <div class="card-header">
                <h5>Hi {{$message_email->member->firstName}},</h5>
                <span class="font-weight-light">Thank for your choose MMOZONE Games.</span>
                <h2>Order ID: {{$message_email->order->order_no}}</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">Order Items</h5>
                <p class="card-text">{{$message_email->order->created_at}}</p>
                <table class="table">
                    <thead>
                    <tr>
                        <td>Name:</td>
                        <td>Price:</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($message_email->products as $product)
                    <tr>
                        <td>{{ json_decode($product->pdt_snapshot)->name }}</td>
                        <td>{{ $product->count }} x € {{ json_decode($product->pdt_snapshot)->price * json_decode($product->pdt_snapshot)->margin }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr class="my-4">
                TOTAL[EUR]: € {{$message_email->order->total_price}}
                <hr class="my-4">
            </div>
        </div>
        <span class="font-weight-light">need help? <a href="mailto:info@mmozone.de" class="font-weight-bolder text-success">info@mmozone.de</a></span>
        <div class="font-weight-light text-black-50">© 2011-2020 MMOZONE Games, Inc. xxx straße xx, 11234 xxxx, Deutschland</div>
    </div>
</div>


</body>
</html>
