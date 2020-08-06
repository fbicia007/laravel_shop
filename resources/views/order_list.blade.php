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
                    <div class="col-sm text-secondary"><h6>2 ORDER INFORMATION</h6></div>
                    <div class="col-sm"><h6> > </h6></div>
                    <div class="col-sm"><h6>3 COMPLETE PAYMENT</h6></div>
                </div>

                <div class="row">
                    @foreach($orders as $order)
                    <div class="card col-sm-12">
                        <div class="card-header">
                            Order number: {{$order->order_no}}
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                @foreach($orders as $order)
                                    <tr id="" class="items">
                                        <td class="align-middle">
                                            <div class="media">
                                                <img src="/images/preview/" class="align-self-center mr-3" style="width: 64px;">
                                                <div class="media-body">
                                                    <p class="mt-0"></p>
                                                    <p class="font-weight-lighter"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle" id="priceSum{"></td>
                                    </tr>
                                @endforeach
                                <tr id="sum">
                                    <td class="align-middle">
                                        Total:
                                    </td>
                                    <td class="align-middle" id="totalprice">

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach


                </div>

            </div>
        </div>


    </main>

@endsection

@section('my-js')

    <script>


        function paypal() {
            var paypal = 0;

            if(paypal != 0){
                console.log('ok');
            }else{
                console.log('buok');
            }
        }
    </script>

@endsection
