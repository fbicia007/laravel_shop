@extends('master')

@section('title','forgot password')


@section('content')

    <div class="row justify-content-md-center pt-5 pb-5">

        <div class="card">
            <div class="card-header text-center">
                Change your password
            </div>
            <div class="card-body">
                <div id="forgot_pw-form">
                    <div class="form-group">
                        <label for="new_password" class="col-form-label">New Password:</label>
                        <input type="password" class="form-control" id="new_password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="confirm_password" placeholder="re-enter new password">
                    </div>

                    <button class="btn btn-primary col-12" data-action='submit' id="save">Save</button>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('my-js')
    <script>

        function getQueryString(name) {
            let reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
            let r = window.location.search.substr(1).match(reg);
            if (r != null) {
                return decodeURIComponent(r[2]);
            };
            return null;
        }

        var code = getQueryString("code");
        var member_id =  getQueryString("member_id");

        $(document).ready(function(){
            $("button#save").click(function(){

                var password = $('#new_password').val();
                var confirm = $('#confirm_password').val();

                if(password =='' || confirm ==''){
                    $('#errorMessage').modal('show');
                    $('.modal-body span').html('Inputs cannot be empty');
                    setTimeout(function () {
                        $('#errorMessage').modal('toggle');
                    }, 2000);
                    return false;
                }
                if(password.length <8 || confirm.length <8) {
                    $('#errorMessage').modal('show');
                    $('.modal-body span').html('Your password must be 8-20 characters.');
                    setTimeout(function () {
                        $('#errorMessage').modal('toggle');
                    }, 2000);
                    return false;
                }
                if(password != confirm) {
                    $('#errorMessage').modal('show');
                    $('.modal-body span').html('Confirmed password does not match the new password, please enter again.');
                    setTimeout(function () {
                        $('#errorMessage').modal('toggle');
                    }, 2000);
                    return false;
                }

                document.getElementById("save").disabled = true;

                $.ajax({
                    url: '/service/change_password',
                    dataType: 'json',
                    type: "POST",
                    cache: false,
                    data: {password:password,member_id:member_id,code:code, _token:"{{csrf_token()}}"},
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
