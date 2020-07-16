@extends('master')

@section('title','category')

@section('categoryMenu')
    @foreach($categorys as $category)
        <a class="dropdown-item" href="/category/{{$category->id}}">{{$category->name}}</a>
    @endforeach
@endsection

@section('footerList')
    @foreach($categorys as $category)
        <li><a class="text-muted" href="/category/{{$category->id}}">{{$category->name}}</a></li>
    @endforeach
@endsection

@section('content')


    <main role="main">
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row text-center">
                    <div class="col-sm"><h6>1 SHOPPING CART</h6></div>
                    <div class="col-sm"><h6> > </h6></div>
                    <div class="col-sm text-secondary"><h6>2 ORDER INFORMATION</h6></div>
                    <div class="col-sm"><h6> > </h6></div>
                    <div class="col-sm text-secondary"><h6>3 COMPLETE PAYMENT</h6></div>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Number</th>
                        <th scope="col"></th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart_items as $cart_item)
                    <tr id="{{$cart_item->product->id}}">
                        <td class="col">
                            <div class="row">
                                <div class="col-md-2 align-middle">
                                    <img src="/images/preview/{{$cart_item->product->preview}}" class="card-img" style="width: 130px;">
                                </div>
                                <div class="col-md-10">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$cart_item->product->name}} - {{$cart_item->categoryName}}</h5>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="col align-middle">{{$cart_item->count}}</td>
                        <td class="col align-middle">€ </td>
                        <td class="col align-middle">{{$cart_item->product->price * $cart_item->count}}</td>
                        <td class="col align-middle">
                            <button type="button" onclick="onDelete({{$cart_item->product->id}})" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn btn-info col-md-2 offset-md-10" onclick="checkout()">checkout</button>
            </div>
        </div>


    </main>

@endsection

@section('my-js')

    <script>
        function onDelete(cartItem_id) {

            $.ajax({
                url: '/service/delete/cart',
                dataType: 'json',
                type: "GET",
                cache: true,
                data: {cartItem_id, cartItem_id},
                success: function (data) {
                    if(data == null){
                        $('#errorMessage').modal('show');
                        $('.modal-body span').html('Server error!');
                        setTimeout(function () {
                            $('#errorMessage').modal('toggle');
                        }, 2000);
                        return;
                    }
                    if(data.status != 0){
                        $('#errorMessage').modal('show');
                        $('.modal-body span').html(data.message);
                        setTimeout(function () {
                            $('#errorMessage').modal('toggle');
                        }, 2000);
                        return;
                    }

                    $('#errorMessage').modal('show');
                    $('.modal-body span').html(data.message);
                    setTimeout(function () {
                        $('#errorMessage').modal('toggle');
                    }, 1000);

                    location.reload();

                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });

        }

        function checkout() {
            location.href='/checkout';
        }
    </script>

@endsection
