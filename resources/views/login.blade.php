@extends('master')

@section('title','login')

@section('content')

    <div class="row justify-content-md-center">

        <div class="col-3">
            <form>
                <div class="form-group">
                    <label for="exampleDropdownFormEmail2">Email address</label>
                    <input type="email" class="form-control" id="exampleDropdownFormEmail2" placeholder="email@example.com">
                </div>
                <div class="form-group">
                    <label for="exampleDropdownFormPassword2">Password</label>
                    <input type="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="dropdownCheck2">
                        <label class="form-check-label" for="dropdownCheck2">
                            Remember me
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>

                <div class="form-group">
                    <a href="register" class="form-check-label" for="dropdownCheck2">
                        Dont have account, register now!
                    </a>
                </div>

            </form>
        </div>
    </div>



@endsection