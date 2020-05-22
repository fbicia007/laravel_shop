@extends('master')

@section('title','login')

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
                <form id="login-form">
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                    </div>
                    <button type="" class="btn btn-light">Forgot password?</button>

                    <button class="btn btn-primary"
                            data-sitekey="reCAPTCHA_site_key"
                            data-callback='onSubmit'
                            data-action='submit'>Sign in</button>

                </form>
            </div>
        </div>
    </div>


@endsection

@section('my-js')
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("login-form").submit();
        }
    </script>
@endsection