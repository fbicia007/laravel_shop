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

                <div class="row">
                    <div class="col-sm-4">
                        <div class="card-header">
                            {{$member->lastName}} {{$member->firstName}}
                        </div>
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Account Overview</a>
                            <a class="list-group-item list-group-item-action" id="list-security-list" data-toggle="list" href="#list-security" role="tab" aria-controls="security">Security</a>
                            <a class="list-group-item list-group-item-action" id="list-orders-list" data-toggle="list" href="#list-orders" role="tab" aria-controls="orders">My Orders</a>
                        </div>
                    </div>


                    <div class="col-sm-8">

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                <div class="card-header">
                                    Account Overview
                                </div>
                                <table class="table table-striped table-light">
                                    <tbody>
                                    <tr>
                                        <td>Name:</td>
                                        <td>{{$member->firstName}} {{$member->lastName}} </td>
                                        <td> <button class="btn btn-outline-info" data-toggle="modal" data-target="#name">Edit</button> </td>
                                    </tr>
                                    <tr>
                                        <td>Phone:</td>
                                        <td>{{$member->phone}}</td>
                                        <td> <button class="btn btn-outline-info" data-toggle="modal" data-target="#phone">Edit</button> </td>
                                    </tr>
                                    <tr>
                                        <td>Address:</td>
                                        <td>{{$member->street}} , {{$member->zip}} {{$member->city}} {{$member->state}}</td>
                                        <td> <button class="btn btn-outline-info" data-toggle="modal" data-target="#address">Edit</button> </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="list-security" role="tabpanel" aria-labelledby="list-security-list">
                                <div class="card-header">
                                    Security
                                </div>
                                <table class="table table-striped table-light">
                                    <tbody>
                                    <tr>
                                        <td>Account-ID (E-Mail address)</td>
                                        <td>{{$member->email}}</td>
                                        <td> <button class="btn btn-outline-info" data-toggle="modal" data-target="#account_id">Edit</button> </td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td>********</td>
                                        <td> <button class="btn btn-outline-info" data-toggle="modal" data-target="#password">Edit</button> </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade show" id="list-orders" role="tabpanel" aria-labelledby="list-orders-list">
                                    @foreach($orders as $order)
                                        <div class="card mb-2">
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
        <!-- Modal -->
        <div class="modal fade modal-dialog" id="name" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title col-md-2 ml-auto" id="staticBackdropLabel">NAME</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="firstname" class="col-form-label">Firstname:</label>
                                <input type="text" class="form-control" id="firstname" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="col-form-label">Lastname:</label>
                                <input type="text" class="form-control" id="lastname" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="for_name">Save change</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-dialog" id="phone" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title col-md-2 ml-auto" id="staticBackdropLabel">Phone</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="phone" class="col-form-label">Phone:</label>
                                <input type="text" class="form-control" id="new_phone">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="for_phone">Save change</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-dialog" id="address" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title col-md-2 ml-auto" id="staticBackdropLabel">Address</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="street" class="col-form-label">Street & Nr.:</label>
                                <input type="text" class="form-control" id="street">
                            </div>
                            <div class="form-group">
                                <label for="zip" class="col-form-label">Zip:</label>
                                <input type="text" class="form-control" id="zip">
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-form-label">City:</label>
                                <input type="text" class="form-control" id="city">
                            </div>
                            <div class="form-group">
                                <label for="country" class="col-form-label">Country:</label>
                                <input type="text" class="form-control" id="country">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="for_address">Save change</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-dialog" id="account_id" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title col-md-4 ml-auto" id="staticBackdropLabel">Account-ID</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="text" class="form-control" id="email">
                                <span  class="blockquote-footer">after you change the Email, you will receive an active link in your new email</span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="for_account">Save change</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-dialog" id="password" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title col-md-2 ml-auto" id="staticBackdropLabel">Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="current_password" class="col-form-label">Current Password:</label>
                                <input type="password" class="form-control" id="current_password">
                            </div>
                            <div class="form-group">
                                <label for="new_password" class="col-form-label">New Password:</label>
                                <input type="password" class="form-control" id="new_password">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="confirm_password" placeholder="re-enter new password">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="for_password">Save change</button>
                    </div>
                </div>
            </div>
        </div>



    </main>

@endsection

@section('my-js')

    <script>

        //name
        $(document).ready(function(){

            $(".btn-primary").click(function(){

                var member_id = {{$member->id}};

                var firstName = '';
                var lastName='';
                var new_phone='';
                var street='';
                var city='';
                var state='';
                var zip='';
                var email='';
                var current_password='';
                var new_password='';
                var confirm='';
                switch (this.id){

                    case 'for_name':
                        var firstName = $('#firstname').val();
                        var lastName = $('#lastname').val();

                        if( firstName =='' || lastName =='' ){
                            $('#errorMessage').modal('show');
                            $('.modal-body span').html('firstname and lastname cannot be empty');
                            setTimeout(function () {
                                $('#errorMessage').modal('toggle');
                            }, 2000);
                            return false;
                        }
                        document.getElementById(this.id).disabled = true;
                        edit('for_name');
                        break;
                    case 'for_phone':
                        var phone = $('#new_phone').val();
                        if( phone =='' ){
                            $('#errorMessage').modal('show');
                            $('.modal-body span').html('phone number cannot be empty');
                            setTimeout(function () {
                                $('#errorMessage').modal('toggle');
                            }, 2000);
                            return false;
                        }
                        document.getElementById(this.id).disabled = true;
                        edit('for_phone');
                        break;
                    case 'for_address':
                        var street = $('#street').val();
                        var city = $('#city').val();
                        var state = $('#country').val();
                        var zip = $('#zip').val();
                        if( street =='' || city =='' || state =='' || zip =='' ){
                            $('#errorMessage').modal('show');
                            $('.modal-body span').html('street infos cannot be empty');
                            setTimeout(function () {
                                $('#errorMessage').modal('toggle');
                            }, 2000);
                            return false;
                        }
                        document.getElementById(this.id).disabled = true;
                        edit('for_address');
                        break;
                    case 'for_account':
                        var email = $('#email').val();
                        if(email.indexOf('@') == -1 || email.indexOf('.')== -1){
                            $('#errorMessage').modal('show');
                            $('.modal-body span').html('Your email format is incorrect.');
                            setTimeout(function () {
                                $('#errorMessage').modal('toggle');
                            }, 2000);
                            return false;
                        }
                        document.getElementById(this.id).disabled = true;
                        edit('for_account');
                        break;
                    case 'for_password':
                        var current_password = $('#current_password').val();
                        var new_password = $('#new_password').val();
                        var confirm = $('#confirm_password').val();

                        if(new_password.length <8 || confirm.length <8) {
                            $('#errorMessage').modal('show');
                            $('.modal-body span').html('Your password must be 8-20 characters.');
                            setTimeout(function () {
                                $('#errorMessage').modal('toggle');
                            }, 2000);
                            return false;
                        }
                        if(new_password != confirm) {
                            $('#errorMessage').modal('show');
                            $('.modal-body span').html('Confirmed password does not match the new password, please enter again.');
                            setTimeout(function () {
                                $('#errorMessage').modal('toggle');
                            }, 2000);
                            return false;
                        }
                        document.getElementById(this.id).disabled = true;
                        edit('for_password');
                        break;

                }

                function edit(count_type){
                    $.ajax({
                        url: '/service/edit_member',
                        dataType: 'json',
                        type: "POST",
                        cache: false,
                        data: {member_id:member_id, count_type:count_type,firstName:firstName,lastName:lastName,new_phone:phone, street:street, city:city, state:state,zip:zip,email:email, current_password:current_password,new_password:new_password, confirm:confirm,_token:"{{csrf_token()}}"},
                        success: function (data) {
                            if(data == null){
                                $('#errorMessage').modal('show');
                                $('.modal-body span').html('Server error!');
                                setTimeout(function () {
                                    $('#errorMessage').modal('toggle');
                                }, 2000);
                                return;
                            }

                            $('#errorMessage').modal('show');
                            $('.modal-body span').html(data.message);
                            setTimeout(function () {
                                $('#errorMessage').modal('toggle');
                            }, 2000);

                            document.getElementById(count_type).disabled = false;


                            if(data.status == 0){
                                setTimeout(function(){ location.reload(); }, 1000);
                            }

                            return;


                        },
                        error: function (xhr, status, error) {
                            console.log(xhr);
                            console.log(status);
                            console.log(error);
                        }
                    });
                }



            });
        });

    </script>

@endsection
