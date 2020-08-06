@extends('master')

@section('title','category')

@section('categoryMenu')
    @foreach($categories as $category)
        <a class="dropdown-item" href="/category/{{$category->id}}">{{$category->name}}</a>
    @endforeach
@endsection

@section('footerList')
    @foreach($categories as $category)
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
                    <tr class="d-flex">
                        <th class="col-8">Item</th>
                        <th class="col-2">Number</th>
                        <th class="col-1">Total</th>
                        <th class="col-1"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart_items as $cart_item)
                    <tr id="{{$cart_item->product->id}}" class="d-flex items">
                        <td class="col-8 align-middle">
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
                        <td class="col-2 align-middle">
                            <div class="row">
                                <button class="btn btn-outline-info" onclick="dashItem('{{$cart_item->product->id}}')">-</button>
                                <input id="item{{$cart_item->product->id}}" type="text" class="col-sm form-control" value="{{$cart_item->count}}">
                                <button class="btn btn-outline-info" onclick="addItem('{{$cart_item->product->id}}')">+</button>
                            </div>
                        </td>
                        <span class="d-none" id="priceOne{{$cart_item->product->id}}">{{$cart_item->product->price}}</span>
                        <td class="align-middle col-1" id="priceSum{{$cart_item->product->id}}">{{$cart_item->product->price * $cart_item->count}} €</td>
                        <td class="align-middle col-1">
                            <button type="button" onclick="onDelete({{$cart_item->product->id}})" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    <tr id="sum" class="d-flex">
                        <td class="col-11 align-middle">
                            Summe ({{count($cart_items)}} Items)
                        </td>
                        <td class="align-middle col-1" id="totalprice">

                        </td>
                    </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-info col-md-2 offset-md-10" onclick="checkout()">Check Out</button>
            </div>
        </div>


    </main>

@endsection

@section('my-js')

    <script>

        function sumColumn(index) {
            var total = 0;
            $("td:nth-child(" + index + ")").each(function() {
                total += parseFloat($(this).text()) || 0;
            });
            return total;
        }

        $(function() {
            $("#totalprice").html(sumColumn(3).toFixed(2)+'€');
        });

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
            var product_ids_arr = [];
            $('.d-flex.items').each(function () {
                product_ids_arr.push(this.id);

            })

            if(product_ids_arr.length > 0){
                location.href='/checkout';
            }

            $('#errorMessage').modal('show');
            $('.modal-body span').html('You have nothing');
            setTimeout(function () {
                $('#errorMessage').modal('toggle');
            }, 1000);

        }

        function addItem(id) {
            var num = +$('#item'+id).val()+1;
            var priceOne = $('#priceOne'+id).text();
            $('#item'+id).val(num);
            $('#priceSum'+id).text((priceOne * num).toFixed(2) +'€');

            $.ajax({
                url: '/service/add/cart/'+id,
                dataType: 'json',
                type: "GET",
                cache: true,
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
/*
                    $('#errorMessage').modal('show');
                    $('.modal-body span').html(data.message);
                    setTimeout(function () {
                        $('#errorMessage').modal('toggle');
                    }, 1000);
*/
                    var num = $('#cartCount').html();


                    if(num == '') num = 0;
                    $('#cartCount').html(Number(num) + 1);
                    $("#totalprice").html(sumColumn(3).toFixed(2)+'€');

                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });

        }
        function dashItem(id) {
            var num = +$('#item'+id).val()-1;
            if(num >= 0){
                var priceOne = $('#priceOne'+id).text();
                $('#item'+id).val(num);
                $('#priceSum'+id).text((priceOne * num).toFixed(2) +'€');
                $.ajax({
                    url: '/service/dash/cart/'+id,
                    dataType: 'json',
                    type: "GET",
                    cache: true,
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
/*
                        $('#errorMessage').modal('show');
                        $('.modal-body span').html(data.message);
                        setTimeout(function () {
                            $('#errorMessage').modal('toggle');
                        }, 1000);
*/
                        var num = $('#cartCount').html();


                        if(num == '') num = 0;
                        $('#cartCount').html(Number(num) - 1);
                        $("#totalprice").html(sumColumn(3).toFixed(2)+'€');

                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);
                        console.log(status);
                        console.log(error);
                    }
                });
            }


        }
    </script>

@endsection
