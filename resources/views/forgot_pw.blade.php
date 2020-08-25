@extends('master')

@section('title','forgot password')

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
                Forgot Password
            </div>
            <div class="card-body">
                <div id="forgot_pw-form">
                    <div class="form-group">
                        <label>Forgotten your password? Enter your e-mail address below, and we'll send you an e-mail allowing you to reset it.</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide a valid Email.
                        </div>
                    </div>

                    <a class="btn btn-secondary" href="/login">Cancel</a>
                    <button class="btn btn-primary" id="send_email">Send Email</button>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('my-js')
    <script>

        $(document).ready(function(){
            $("button#send_email").click(function(){
                var email = $('#email').val();

                if(email ==''){
                    $('#errorMessage').modal('show');
                    $('.modal-body span').html('Email is empty');
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

                document.getElementById("send_email").disabled = true;

                $.ajax({
                    url: '/service/forgot_password',
                    dataType: 'json',
                    type: "POST",
                    cache: false,
                    data: {email:email, _token:"{{csrf_token()}}"},
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

                            setTimeout(function(){ location.href = "/"; }, 1000);

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
