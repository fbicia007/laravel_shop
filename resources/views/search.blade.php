@extends('master')

@section('title','category')


@section('content')

    <main role="main">
        <div class="container">
            <span><a href="/" class="text-dark">Home</a> / Search</span>
        </div>
        <div class="album py-5 bg-light">
            <div class="container" style="margin-top: -48px;">



                <div class="tab-content border-top" id="pills-tabContent">

                    <div class="form-inline" style="margin-top: 20px; margin-bottom: 20px;">

                        <label class="col-12" id="result">{{count($products)}} Results</label>
                        <!--<label class="col-6"></label>
                         <label class="col-2">Sort:</label>
                         <select id="inputState" class="form-control col-2">
                             <option selected>Highest Professions Level</option>
                             <option>Fastest Delivery</option>
                             <option>Highest Stock Level</option>
                             <option>Lowest Price</option>
                         </select>-->
                    </div>

                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">

                        <div class="form-inline text-center product-group">
                            @foreach($products as $product)
                                <div class="col-sm-2 product-list" style="margin-bottom: 40px">
                                <!--<a href="/product/{{$product->id}}" style="color: black">-->
                                    <img src="{{$product->preview}}" style="width: 100px">
                                    <div>{{$product->name}}</div>
                                    <div>{{$product->summary}}</div>
                                    <div>EUR € {{$product->price * $product->margin}}</div>

                                    <!--</a>-->
                                    <button type="button" class="btn btn-outline-info" onclick="addCart({{$product->id}});">Buy now</button>
                                </div>
                            @endforeach

                        </div>


                    </div>
                </div>
            </div>
        </div>

        <span id="platform_id" value="0"></span>

    </main>

@endsection

@section('my-js')
    <script>
        //under category
        $('#unCategorySelect').change(function (event) {
            var category_id = $('#unCategorySelect option:selected').val();
            var platform_id = $('#platform_id').attr('value');
            if(platform_id == 0){
                var url ='/service/products/'+category_id;
            }else {
                var url ='/service/products/' + category_id + '/platform/' + platform_id;
            }
            $.ajax({
                url: url,
                dataType: 'json',
                type: "POST",
                cache: false,
                data: { _token:"{{csrf_token()}}"},
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
                    //console.log(data);
                    switch (platform_id) {
                        case '0':
                            $('#result').html(data.products.length+' RESULTS');
                            break
                        case '1':
                            $('#ps4-result').html(data.products.length+' RESULTS');
                            break
                        case '2':
                            $('#xbox-result').html(data.products.length+' RESULTS');
                            break
                        case '3':
                            $('#pc-result').html(data.products.length+' RESULTS');
                            break
                    }
                    //$('.list-group').html('');
                    $('.product-group').html('');
                    for(var i=0; i<data.products.length;i++){
                        /*list
                        var node = '<li class="list-group-item">'+
                            '<div class="row">'+
                            '<div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;">'+
                            data.products[i].name+'</span>'+ data.products[i].summary+'</div>'+
                        '<div class="col-6 col-md-2 align-self-center">EUR € '+data.products[i].price+'</div>'+
                        '<div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>'+
                        '</div>                        </li>';
                        $('.list-group').append(node);
                         */
                        var node = '<div class="col-sm-2 product-list" style="margin-bottom: 40px">'+
                            //'<a href="/product/'+data.products[i].id+'" style="color: black">'+
                            '<img src="'+data.products[i].preview+'" style="width: 100px">'+
                            '<div>'+data.products[i].name+'</div>'+
                            '<div>'+ data.products[i].summary+'</div>'+
                            '<div>EUR € '+ data.products[i].price*data.products[i].margin+'</div>'+
                            //'</a>'+
                            '<button type="button" class="btn btn-outline-info" onclick="addCart('+ data.products[i].id +')">Buy now</button>'+
                            '</div>';
                        $('.product-group').append(node);
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        });

        function addCart(product_id) {
            $.ajax({
                url: '/service/add/cart/'+product_id,
                dataType: 'json',
                type: "POST",
                cache: true,
                data: { _token:"{{csrf_token()}}"},
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
