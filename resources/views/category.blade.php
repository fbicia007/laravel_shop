@extends('master')

@section('title','category')

@section('categoryMenu')
    @foreach($categorys as $category)
        <a class="dropdown-item" href="{{$category->id}}">{{$category->name}}</a>
    @endforeach
@endsection

@section('footerList')
    @foreach($categorys as $category)
        <li><a class="text-muted" href="{{$category->id}}">{{$category->name}}</a></li>
    @endforeach
@endsection

@section('content')


    <main role="main">
        <div class="container">
            <span>Home / OnlineGames / {{$thisCategory[0]->name}}</span>
        </div>
        <div class="album py-5 bg-light">
            <div class="container" style="margin-top: -48px;">
                <ul class="nav nav- border-top border-bottom" id="pills-tab" role="tablist">
                    <li class="nav-item-content" value="0">
                        <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">
                            <button type="button" class="btn btn-light float-left" style="height: 120px; width:120px;">
                                <i class="fas fa-check-double"></i>
                                <div>Select All</div>
                            </button>
                        </a>
                    </li>
                    @if(count(explode(",",$thisCategory[0]->platform))>1)
                    @foreach(explode(",",$thisCategory[0]->platform) as $platform)
                        @if($platform == 1)
                            <li class="nav-item-content" value="1">
                                <a class="nav-link" id="pills-pc-tab" data-toggle="pill" href="#pills-pc" role="tab" aria-controls="pills-pc" aria-selected="false">
                                    <button type="button" class="btn btn-light" style="height: 120px; width:120px;">
                                        <i class="fas fa-desktop"></i>
                                        <div>PC</div>
                                    </button>
                                </a>
                            </li>
                            @endif
                            @if($platform == 2)
                                <li class="nav-item-content" value="2">
                                    <a class="nav-link" id="pills-ps4-tab" data-toggle="pill" href="#pills-ps4" role="tab" aria-controls="pills-ps4" aria-selected="false">
                                        <button type="button" class="btn btn-light" style="height: 120px; width:120px;">
                                            <i class="fab fa-playstation"></i>
                                            <div>PLAYSTATION 4</div>
                                        </button>
                                    </a>
                                </li>
                            @endif
                            @if($platform == 3)
                                <li class="nav-item-content" value="3">
                                    <a class="nav-link" id="pills-xbox-tab" data-toggle="pill" href="#pills-xbox" role="tab" aria-controls="pills-xbox" aria-selected="false">
                                        <button type="button" class="btn btn-light" style="height: 120px; width:120px;">
                                            <i class="fab fa-xbox"></i>
                                            <div>XBOX ONE</div>
                                        </button>
                                    </a>
                                </li>
                            @endif
                    @endforeach
                    @endif
                </ul>

                @if(isset($unCategorys))
                    <div class="form-inline justify-content-start" style="margin-top: 20px; margin-bottom: 20px;">
                        <label class="col-2" for="unCategorySelect">Delivery Type</label>
                        <select class="form-control col-3" id="unCategorySelect">
                            <option value="{{$thisCategory[0]->id}}">Select All</option>
                            @foreach($unCategorys as $unCategory)
                            <option value="{{$unCategory->id}}">{{$unCategory->name}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="tab-content border-top" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">

                        <div class="form-inline" style="margin-top: 20px; margin-bottom: 20px;">
                            <label class="col-2" id="result">{{count($products)}} Results</label>
                            <label class="col-6"></label>
                            <label class="col-2">Sort:</label>
                            <select id="inputState" class="form-control col-2">
                                <option selected>Highest Professions Level</option>
                                <option>Fastest Delivery</option>
                                <option>Highest Stock Level</option>
                                <option>Lowest Price</option>
                            </select>
                        </div>

                        <div class="form-inline text-center product-group">
                            @foreach($products as $product)
                                <div class="col-2 product-list" style="margin-bottom: 40px">
                                    <a href="/product/{{$product->id}}" style="color: black">
                                        <img src="https://www.mmoga.com/images/games/_ext/1009361/minecraft_medium.png" style="width: 100px">
                                        <div>{{$product->name}}</div>
                                        <div>{{$product->summary}}</div>
                                        <div>EUR € {{$product->price}}</div>
                                    </a>
                                    <button type="button" class="btn btn-outline-info">Buy now</button>
                                </div>
                            @endforeach

                        </div>


                    </div>


                    <div class="tab-pane fade" id="pills-pc" role="tabpanel" aria-labelledby="pills-pc-tab">
                        <div class="form-inline" style="margin-top: 20px; margin-bottom: 20px;">
                            <label class="col-2" id="pc-result"></label>
                            <label class="col-6"></label>
                            <label class="col-2">Sort:</label>
                            <select id="inputState" class="form-control col-2">
                                <option selected>Highest Professions Level</option>
                                <option>Fastest Delivery</option>
                                <option>Highest Stock Level</option>
                                <option>Lowest Price</option>
                            </select>
                        </div>

                        <ul class="form-inline text-center product-group">


                        </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-ps4" role="tabpanel" aria-labelledby="pills-ps4-tab">
                        <div class="form-inline" style="margin-top: 20px; margin-bottom: 20px;">
                            <label class="col-2" id="ps4-result"></label>
                            <label class="col-6"></label>
                            <label class="col-2">Sort:</label>
                            <select id="inputState" class="form-control col-2">
                                <option selected>Highest Professions Level</option>
                                <option>Fastest Delivery</option>
                                <option>Highest Stock Level</option>
                                <option>Lowest Price</option>
                            </select>
                        </div>

                        <ul class="form-inline text-center product-group">


                        </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-xbox" role="tabpanel" aria-labelledby="pills-xbox-tab">
                        <div class="form-inline" style="margin-top: 20px; margin-bottom: 20px;">
                            <label class="col-2" id="xbox-result">7 RESULTS</label>
                            <label class="col-6"></label>
                            <label class="col-2">Sort:</label>
                            <select id="inputState" class="form-control col-2">
                                <option selected>Highest Professions Level</option>
                                <option>Fastest Delivery</option>
                                <option>Highest Stock Level</option>
                                <option>Lowest Price</option>
                            </select>
                        </div>

                        <ul class="form-inline text-center product-group">


                        </ul>
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
                type: "GET",
                cache: false,
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
                            $('#pc-result').html(data.products.length+' RESULTS');
                            break
                        case '2':
                            $('#ps4-result').html(data.products.length+' RESULTS');
                            break
                        case '3':
                            $('#xbox-result').html(data.products.length+' RESULTS');
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

                    var node = '<div class="col-2 product-list" style="margin-bottom: 40px">'+
                            '<a href="/product/'+data.products[i].id+'" style="color: black">'+
                            '<img src="https://www.mmoga.com/images/games/_ext/1009361/minecraft_medium.png" style="width: 100px">'+
                            '<div>'+data.products[i].name+'</div>'+
                            '<div>'+ data.products[i].summary+'</div>'+
                            '<div>EUR € '+ data.products[i].price+'</div>'+
                        '<button type="button" class="btn btn-outline-info">Buy now</button>'+
                        '</div></a>';

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

        //platform
        $('.nav-item-content').click(function (event) {

            var category_id = {{$thisCategory[0]->id}};
            var platform_id = $(this).attr('value');

            if(platform_id == 0){
                var url ='/service/products/'+category_id;
            }else {
                var url ='/service/products/' + category_id + '/platform/' + platform_id;
            }

            $.ajax({
                url: url,
                dataType: 'json',
                type: "GET",
                cache: false,
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


                    switch (platform_id) {

                        case '0':
                            $('#platform_id').attr('value','0');
                            break
                        case '1':
                            $('#pc-result').html(data.products.length+' RESULTS');
                            $('#platform_id').attr('value','1');
                            break
                        case '2':
                            $('#ps4-result').html(data.products.length+' RESULTS');
                            $('#platform_id').attr('value','2');
                            break
                        case '3':
                            $('#xbox-result').html(data.products.length+' RESULTS');
                            $('#platform_id').attr('value','3');
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
*/
                        var node = '<div class="col-2 product-list" style="margin-bottom: 40px">'+
                            '<a href="/product/'+data.products[i].id+'" style="color: black">'+
                            '<img src="https://www.mmoga.com/images/games/_ext/1009361/minecraft_medium.png" style="width: 100px">'+
                            '<div>'+data.products[i].name+'</div>'+
                            '<div>'+ data.products[i].summary+'</div>'+
                            '<div>EUR € '+ data.products[i].price+'</div>'+
                            '<button type="button" class="btn btn-outline-info">Buy now</button>'+
                            '</div></a>';

                        //$('.list-group').append(node);
                        $('.product-group').append(node);
                    }


                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });

            $('#unCategorySelect').get(0).selectedIndex = 0;

        });

    </script>



@endsection
