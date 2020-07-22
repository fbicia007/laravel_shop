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
                                        <table class="table table-striped table-light">
                                            <tbody>
                                            <thead>
                                            <tr>
                                                <th scope="col">Order ID</th>
                                                <th scope="col">Time</th>
                                            </tr>
                                            </thead>
                                                @foreach($orders as $order)
                                            <tr>
                                                <td>{{$order[0]->order_id}}</td>
                                                <td>{{$order[0]->created_at}}</td>
                                            </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
