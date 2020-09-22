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
                            {{$speicial_infos}}

                            <input type="text" name="order_id" value="{{$order_id}}" hidden>
                            <div id="paypal-button-container"></div>
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
                                    <tr id="{{json_decode($cart_item->pdt_snapshot)->id}}" class="items">
                                        <td class="align-middle">
                                            <div class="media">
                                                <img src="{{json_decode($cart_item->pdt_snapshot)->preview}}" class="align-self-center mr-3" style="width: 64px;">
                                                <div class="media-body">
                                                    <p class="mt-0">{{json_decode($cart_item->pdt_snapshot)->name}}</p>
                                                    <p class="font-weight-lighter">€{{json_decode($cart_item->pdt_snapshot)->price * json_decode($cart_item->pdt_snapshot)->margin}} x {{$cart_item->count}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">{{json_decode($cart_item->pdt_snapshot)->price * json_decode($cart_item->pdt_snapshot)->margin * $cart_item->count}} €</td>
                                    </tr>
                                @endforeach
                                <tr id="sum">
                                    <td class="align-middle">
                                        Total:
                                    </td>
                                    <td class="align-middle" id="totalprice">
                                        {{$total_price}} €
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" id="afterPay" class="btn btn-success" disabled>
                                <h5 class="card-title">Finish</h5>
                                <p class="card-text">After your pay click here to show the bill.</p>
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
                    document.getElementById("afterPay").addEventListener('click', function(event) {
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
    <script src="https://www.paypal.com/sdk/js?client-id=AUAXCQ0WrQqoKL83IENCwBxWL6AWGPxIPsHmz3MNKiFRyk5pkGil1lO9gyc1EG3_IrnYwdW1rM0G0aNR&currency=EUR"></script>

    <script>
        paypal.Buttons({

            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{$total_price}}'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    document.getElementById("afterPay").removeAttribute("disabled");
                });
            }
        }).render('#paypal-button-container');
        //This function displays Smart Payment Buttons on your web page.
    </script>

@endsection
