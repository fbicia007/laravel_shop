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
                <div class="row text-center" style="margin-bottom: 20px;">
                    <div class="col-sm text-secondary"><h6>1 SHOPPING CART</h6></div>
                    <div class="col-sm"><h6> > </h6></div>
                    <div class="col-sm"><h6>2 ORDER INFORMATION</h6></div>
                    <div class="col-sm"><h6> > </h6></div>
                    <div class="col-sm text-secondary"><h6>3 COMPLETE PAYMENT</h6></div>
                </div>

                <form id="pay-form" action="/pay" method="post" class="needs-validation" >

                    {{csrf_field()}}
                <div class="row">
                    <div class="card col-sm-8">
                        <div class="card-header">
                            Shipping Information
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Please tell us your game information</h5>
                            <p class="card-text">If you see this infos, that's means our deliver service must use them.</p>
                                @foreach($speicial_infos as $speicial_info)
                                    @if($speicial_info != null)
                                        @foreach(explode("|",$speicial_info) as $special_info)
                                            <div class="container">
                                                <div class="form-group">
                                                    <label>{{$special_info}} *</label>
                                                    <input type="text" class="form-control" name="{{$special_info}}" required>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            <input type="text" name="order_id" value="{{$order_id}}" hidden>

                        </div>
                    </div>

                    <div class="card col-sm-4">
                        <div class="card-header">
                            Order Summary
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                @foreach($cart_items as $cart_item)
                                    <tr id="{{$cart_item->product->id}}" class="items">
                                        <td class="align-middle">
                                            <div class="media">
                                                <img src="{{$cart_item->product->preview}}" class="align-self-center mr-3" style="width: 64px;">
                                                <div class="media-body">
                                                    <p class="mt-0">{{$cart_item->product->name}} - {{$cart_item->category->name}}</p>
                                                    <p class="font-weight-lighter">€{{$cart_item->product->price}} x {{$cart_item->count}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">{{$cart_item->product->price * $cart_item->count}} €</td>
                                    </tr>
                                @endforeach
                                <tr id="sum">
                                    <td class="align-middle">
                                        Total:
                                    </td>
                                    <td class="align-middle" id="totalprice">
                                        {{$total_price}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" id="paypalPay" class="btn btn-light">
                                <h5 class="card-title">PayPal</h5>
                                <p class="card-text">You will be redirected to PayPal after placing order.</p>
                                <img src="/images/logo/PayPal-Logo.png" class="rounded mx-auto d-block" width="100px">
                            </button>
                        </div>
                    </div>


                </div>
                </form>
            </div>
        </div>


    </main>


@endsection

@section('my-js')

    <script>
        // Validate
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    document.getElementById("paypalPay").addEventListener('click', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

@endsection
