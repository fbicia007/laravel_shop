@extends('master')

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
                <form id="register-form">
                    <div class="form-group">
                        <label>Email address:</label>
                        <input type="email" class="form-control" id="reg_email" name="reg_email" placeholder="email@example.com">
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Password(again):</label>
                        <input type="password" class="form-control" id="reg_password_again" name="reg_password_again" placeholder="Password(again)">
                    </div>
                    <div class="form-group">
                        <label>Confirm Code:</label>
                        <input type="hidden" class="form-control" id="confirm_code" name="confirm_code" placeholder="confirm code">
                    </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>


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
@endsection