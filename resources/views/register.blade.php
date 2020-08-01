@extends('master')

@section('title','register')

@section('categoryMenu')
    @foreach($categorys as $category)
        <a class="dropdown-item" href="category/{{$category->id}}">{{$category->name}}</a>
    @endforeach
@endsection

@section('footerList')
    @foreach($categorys as $category)
        <li><a class="text-muted" href="category/{{$category->id}}">{{$category->name}}</a></li>
    @endforeach
@endsection

@section('content')


    <div class="row justify-content-md-center pt-5 pb-5">

        <div class="card">
            <div class="card-header text-center">
                Sign Up
            </div>
            <div class="card-body">
                <h6 class="card-title"><a href="login" class="form-check-label" for="dropdownCheck2">
                        Already have an account? Then please sign in.
                    </a>
                </h6>


                <form id="register-form" method="post" onsubmit="return false" class="needs-validation" oninput='confirm_reg_password.setCustomValidity(confirm_reg_password.value != reg_password.value ? " " : "")' novalidate>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label>Email address:</label>
                            <input type="email" class="form-control" id="reg_email" name="reg_email" placeholder="email@example.com" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid Email.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Password:</label>
                            <input type="password" class="form-control" id="reg_password" name="reg_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" placeholder="Password" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Enter new password again:</label>
                            <input type="password" class="form-control" id="confirm_reg_password" name="confirm_reg_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Confirm Password" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Confirmed password does not match the new password, please enter again
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="first_name">First name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid Text.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="last_name">Last name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid Text.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid State.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid zip.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                                Agree to terms and conditions
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="register">Register</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('my-js')
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("register-form").submit();
        }
    </script>
    <script>
        // Validate
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    document.getElementById("register").addEventListener('click', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        //register
        $(document).ready(function(){
            $("button#register").click(function(){
                var email = $('input[name=reg_email]').val();
                var password = $('input[name=reg_password]').val();
                var confirm = $('input[name=confirm_reg_password]').val();
                var firstName = $('input[name=first_name]').val();
                var lastName = $('input[name=last_name]').val();
                var city = $('input[name=city]').val();
                var state = $('input[name=state]').val();
                var zip = $('input[name=zip]').val();


                if(email =='' || password =='' || confirm =='' || firstName =='' || lastName =='' || city =='' || state =='' || zip ==''){
                    $('#errorMessage').modal('show');
                    $('.modal-body span').html('Infos cannot be empty');
                    setTimeout(function () {
                        $('#errorMessage').modal('toggle');
                    }, 2000);
                    return false;
                }
                if(!$('#invalidCheck').is(':checked')){
                    $('#errorMessage').modal('show');
                    $('.modal-body span').html('Your must agree our terms and conditions.');
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


                document.getElementById("register").disabled = true;
                $.ajax({
                    url: '/service/register',
                    dataType: 'json',
                    type: "POST",
                    cache: false,
                    data: {email:email, password:password,confirm:confirm,firstName:firstName,lastName:lastName, city:city, state:state,zip:zip, _token:"{{csrf_token()}}"},
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
                        document.getElementById("register").disabled = false;

                        if(data.status == 0){
                            setTimeout(function(){ location.href = "/"; }, 1000);
                        }

                        return;


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
