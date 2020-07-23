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

                <div class="row">
                    <div class="col-sm-4">
                        <div class="card-header">
                            {{$member->lastName}} {{$member->firstName}}
                        </div>
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Account Overview</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">My Orders</a>
                        </div>
                    </div>


                    <div class="col-sm-8">
                        <div class="card-header">
                            Information
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                    <table class="table table-striped table-light">
                                        <tbody>
                                        <tr>
                                            <td>Last Name</td>
                                            <td>{{$member->lastName}}</td>
                                            <td> <button class="btn btn-outline-info">Edit</button> </td>
                                        </tr>
                                        <tr>
                                            <td>First Name</td>
                                            <td>{{$member->firstName}}</td>
                                            <td> <button class="btn btn-outline-info">Edit</button> </td>
                                        </tr>
                                        <tr>
                                            <td>E-mail</td>
                                            <td>{{$member->email}}</td>
                                            <td> <button class="btn btn-outline-info">Edit</button> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">

                                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                        @foreach($orders as $order)
                                            <div class="card">
                                                <h5 class="card-header text-muted font-weight-light">
                                                    <div class="row">
                                                        <span class="col-sm-10">Order Number: {{$order->order_no}}</span>
                                                        @if($order->status == 1)<span class="col-sm-2 text-danger"> Unpaid </span>
                                                        @else
                                                        <span class="col-sm-2 text-success">Paid</span>
                                                        @endif
                                                    </div>

                                                </h5>
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        @foreach($order->order_items as $order_item)
                                                        <div class="row border-bottom">
                                                            <div class="media col-sm-10">
                                                                <img src="/images/preview/{{$order_item->product->preview}}" class="align-self-center mr-3" style="width: 64px;">
                                                                <div class="media-body">
                                                                    <p class="mt-0">{{$order_item->product->name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="align-middle col-sm-2">€{{$order_item->product->price}} x {{$order_item->count}}</div>
                                                        </div>
                                                @endforeach
                                                    </p>
                                    <p>Total: {{$order->total_price}}€</p>
                                                </div>
                                            </div>
                                                @endforeach

                                    </div>

                                </div>
                            </div>
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
