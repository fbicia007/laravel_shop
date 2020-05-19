@extends('master')

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
                <button type="submit" class="btn btn-primary">Regist</button>

                <div class="form-group">
                    <a href="login" class="form-check-label" for="dropdownCheck2">
                        already have an account? login here.
                    </a>
                </div>

            </form>
        </div>
    </div>

@endsection