@extends('master')

@section('title','category')

@section('categoryMenu')
    @foreach($categories as $category)
        <a class="dropdown-item" href="/category/{{$category->id}}">{{$category->name}}</a>
    @endforeach
@endsection

@section('footerList')
    @foreach($categories as $category)
        <li><a class="text-muted" href="/category/{{$category->id}}">{{$category->name}}</a></li>
    @endforeach
@endsection

@section('content')


<main role="main">
    <div class="container">
        <span>Home / OnlineGames / {{$thisCategory[0]->name}}</span>
    </div>
    <div class="album py-5 bg-light">
        <div class="container" style="margin-top: -48px;">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/images/preview/{{$product[0]->preview}}" class="card-img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{$product[0]->name}}</h5>
                            <p class="card-text">{{$product[0]->price}} €</p>
                            <p class="card-text"><small class="text-muted">{{$product[0]->summary}}</small></p>
                            <button type="button" class="btn btn-outline-info" onclick="addCart({{$product[0]->id}});">Buy now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>


@endsection

@section('my-js')
<script>
    function addCart(product_id) {

        $.ajax({
            url: '/service/add/cart/'+product_id,
            dataType: 'json',
            type: "GET",
            cache: true,
            success: function (data) {
                if(data == null){
                    $('#errorMessage').modal('show');
                    $('.modal-body span').html('Server error!');
                    setTimeout(function () {
                        $('#errorMessage').modal('toggle');
                    }, 2000);
                    return;
                }
                if(data.status != 0){
                    $('#errorMessage').modal('show');
                    $('.modal-body span').html(data.message);
                    setTimeout(function () {
                        $('#errorMessage').modal('toggle');
                    }, 2000);
                    return;
                }

                $('#errorMessage').modal('show');
                $('.modal-body span').html(data.message);
                setTimeout(function () {
                    $('#errorMessage').modal('toggle');
                }, 1000);

                var num = $('#cartCount').html();


                if(num == '') num = 0;
                $('#cartCount').html(Number(num) + 1);

            },
            error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    }
</script>



@endsection
