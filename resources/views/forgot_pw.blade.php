@extends('master')

@section('title','forgot password')

@section('categoryMenu')
    @foreach($categorys as $category)
        <a class="dropdown-item" href="cat{{$category->id}}.php">{{$category->name}}</a>
    @endforeach
@endsection

@section('footerList')
    @foreach($categorys as $category)
        <li><a class="text-muted" href="cat{{$category->id}}.php">{{$category->name}}</a></li>
    @endforeach
@endsection

@section('content')

    <div class="row justify-content-md-center pt-5 pb-5">

        <div class="card">
            <div class="card-header text-center">
                Sign In
            </div>
            <div class="card-body">
                <form id="forgot_pw-form" class="needs-validation" novalidate>
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

                    <button class="btn btn-primary"
                            data-sitekey="reCAPTCHA_site_key"
                            data-callback='onSubmit'
                            data-action='submit'>Send Email</button>

                </form>
            </div>
        </div>
    </div>


@endsection

@section('my-js')
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("forgot_pw-form").submit();
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
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
