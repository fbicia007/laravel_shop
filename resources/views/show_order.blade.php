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

                    <div class="card col-sm-12">
                        <div class="modal-header">
                            <h5 class="modal-title">Thank your.</h5>
                        </div>
                        <div class="card-header">
                            Order number: {{$order->order_no}}
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                @foreach($products as $product)
                                    <tr id="" class="items">
                                        <td class="align-middle">
                                            <div class="media">
                                                <img src="/images/preview/{{ json_decode($product->pdt_snapshot)->preview }}" class="align-self-center mr-3" style="width: 64px;">
                                                <div class="media-body">
                                                    <p class="mt-0">{{ json_decode($product->pdt_snapshot)->name }}</p>
                                                    <p class="font-weight-lighter">{{ json_decode($product->pdt_snapshot)->price }} € x {{$product->count}}</p>
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
                                        {{$order->total_price}} €
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <a type="button" class="btn btn-primary btn-lg" href="/">continue</a>
                        </div>
                    </div>


                </div>

            </div>
        </div>


    </main>

@endsection

@section('my-js')

    <script>

    </script>

@endsection
