@extends('master')

@section('title','login')

@section('categoryMenu')
    @foreach($categories as $category)
        <a class="dropdown-item" href="category/{{$category->id}}">{{$category->name}}</a>
    @endforeach
@endsection

@section('footerList')
    @foreach($categories as $category)
        <li><a class="text-muted" href="category/{{$category->id}}">{{$category->name}}</a></li>
    @endforeach
@endsection

@section('content')

    <div class="row justify-content-md-center pt-5 pb-5">

        <div class="card">
            <div class="card-header text-center">
                Sign In
            </div>
            <div class="card-body">
                <h6 class="card-title"><a href="register" class="form-check-label" for="dropdownCheck2">
                        If you do not have an account, you can register here.
                    </a>
                </h6>
                <form id="login-form" method="post" onsubmit="return false" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide a valid Email.
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Password" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide a valid Password.
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                    </div>
                    <a href="forgot_pw" class="btn btn-light">Forgot password?</a>

                    <button class="btn btn-primary" id="login">Sign in</button>

                </form>
            </div>
        </div>
    </div>


@endsection

@section('my-js')

    <script>

        //login
        $(document).ready(function(){
            $("button#login").click(function(){
                var email = $('input[name=email]').val();
                var password = $('input[name=password]').val();



                if(email =='' || password ==''){
                    $('#errorMessage').modal('show');
                    $('.modal-body span').html('Email or password is wrong');
                    setTimeout(function () {
                        $('#errorMessage').modal('toggle');
                    }, 2000);
                    return false;
                }
                if(email.indexOf('@') == -1 || email.indexOf('.')== -1){
                    $('#errorMessage').modal('show');
                    $('.modal-body span').html('Your email format is incorrect.');
                    setTimeout(function () {
                        $('#errorMessage').modal('toggle');
                    }, 2000);
                    return false;
                }
                if(password.length <8) {
                    $('#errorMessage').modal('show');
                    $('.modal-body span').html('Your password must be 8-20 characters.');
                    setTimeout(function () {
                        $('#errorMessage').modal('toggle');
                    }, 2000);
                    return false;
                }


                $.ajax({
                    url: '/service/login',
                    dataType: 'json',
                    type: "POST",
                    cache: false,
                    data: {email:email, password:password, _token:"{{csrf_token()}}"},
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

                        if(data.status == 0){

                            @if($return_url=='')
                            setTimeout(function(){ location.href = "/"; }, 1000);
                            @else
                            setTimeout(function(){ location.href = "{{$return_url}}"; }, 1000);
                            @endif
                        }


                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);
                        console.log(status);
                        console.log(error);
                    }
                });

            });
        });
    </script>
@endsection
