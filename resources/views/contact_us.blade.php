@extends('master')

@section('title','category')

@section('categoryMenu')
    @foreach($categories as $category)
        <a class="dropdown-item" href="{{$category->id}}">{{$category->name}}</a>
    @endforeach
@endsection

@section('footerList')
    @foreach($categories as $category)
        <li><a class="text-muted" href="{{$category->id}}">{{$category->name}}</a></li>
    @endforeach
@endsection

@section('content')

    <main role="main">
        <div class="container">
            <span><a href="/" class="text-dark">Home</a> / Privacy Policy</span>
        </div>
        <div class="album py-5 bg-light">
            <div class="container" style="margin-top: -48px;">
                <div class="mt-5 mb-5">
                    <h5 class="card-title">Submit a request</h5>
                    <p class="card-text"><small class="text-muted">Please outline your issue here. Someone from our friendly and knowledgeable staff will be with you as soon as possible (typically within 24 hours).</small></p>
                </div>

                <div class="card mt-10">
                    <div class="card-body">

                        <form id="contact" accept-charset="UTF-8">
                            <div class="form-group">
                                <label for="email">Your email address *</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="problem_type">Problem type *</label>
                                <select class="form-control" id="problem_type" required>
                                    <option value="" selected>Choose...</option>
                                    <option value="1">refunds and returns</option>
                                    <option value="2">general questions</option>
                                    <option value="3">suggestions</option>
                                    <option value="4">publisher offers for MMOZONE Games</option>
                                    <option value="5">other questions</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject *</label>
                                <input type="text" class="form-control" id="subject" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description *</label>
                                <textarea class="form-control" id="description" rows="3" required></textarea>
                            </div>
                            <button type="button" id="sendRequest" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>


    </main>

@endsection

@section('my-js')
    <script>

        $(document).ready(function(){
            $("button#sendRequest").click(function(){

                var email = $('#email').val();
                var problem_type = $('#problem_type').val();
                var subject = $('#subject').val();
                var description = $('#description').val();

                $.ajax({
                    url: '/service/contact',
                    dataType: 'json',
                    type: "POST",
                    cache: false,
                    data: {email:email,problem_type:problem_type,subject:subject,description:description,_token:"{{csrf_token()}}"},
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
