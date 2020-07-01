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
                @if($thisCategory[0]->id == 1)
                <ul class="nav nav- border-top border-bottom" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">
                            <button type="button" class="btn btn-light float-left" style="height: 120px; width:120px;">
                                <i class="fas fa-check-double"></i>
                                <div>Select All</div>
                            </button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-pc-tab" data-toggle="pill" href="#pills-pc" role="tab" aria-controls="pills-pc" aria-selected="false">
                            <button type="button" class="btn btn-light" style="height: 120px; width:120px;">
                                <i class="fas fa-desktop"></i>
                                <div>PC</div>
                            </button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-ps4-tab" data-toggle="pill" href="#pills-ps4" role="tab" aria-controls="pills-ps4" aria-selected="false">
                            <button type="button" class="btn btn-light" style="height: 120px; width:120px;">
                                <i class="fab fa-playstation"></i>
                                <div>PLAYSTATION 4</div>
                            </button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-xbox-tab" data-toggle="pill" href="#pills-xbox" role="tab" aria-controls="pills-xbox" aria-selected="false">
                            <button type="button" class="btn btn-light" style="height: 120px; width:120px;">
                                <i class="fab fa-xbox"></i>
                                <div>XBOX ONE</div>
                            </button>
                        </a>
                    </li>
                </ul>
                @endif

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
                        <ul class="list-group" id="productList">
                            @foreach($products as $product)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;">
                                            {{$product->name}}</span> {{$product->summary}}
                                        @switch($product->platform)
                                            @case(0)
                                                PS4
                                                @break
                                            @case(1)
                                                XBOX
                                                @break
                                            @case(2)
                                                PC
                                                @break
                                        @endswitch
                                    </div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € {{$product->price}}</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                    </div>


                    <div class="tab-pane fade" id="pills-pc" role="tabpanel" aria-labelledby="pills-pc-tab">
                        <div class="form-inline" style="margin-top: 20px; margin-bottom: 20px;">
                            <label class="col-2">18 RESULTS</label>
                            <label class="col-6"></label>
                            <label class="col-2">Sort:</label>
                            <select id="inputState" class="form-control col-2">
                                <option selected>Highest Professions Level</option>
                                <option>Fastest Delivery</option>
                                <option>Highest Stock Level</option>
                                <option>Lowest Price</option>
                            </select>
                        </div>

                        <ul class="list-group">

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 100K</span> Safe FUT 20 Coins PS4</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>


                        </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-ps4" role="tabpanel" aria-labelledby="pills-ps4-tab">
                        <div class="form-inline" style="margin-top: 20px; margin-bottom: 20px;">
                            <label class="col-2">7 RESULTS</label>
                            <label class="col-6"></label>
                            <label class="col-2">Sort:</label>
                            <select id="inputState" class="form-control col-2">
                                <option selected>Highest Professions Level</option>
                                <option>Fastest Delivery</option>
                                <option>Highest Stock Level</option>
                                <option>Lowest Price</option>
                            </select>
                        </div>

                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 100K</span> Safe FUT 20 Coins PS4</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 200K</span> Safe FUT 20 Coins PS4</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 300K</span> Safe FUT 20 Coins PS4</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 400K</span> Safe FUT 20 Coins PS4</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 500K</span> Safe FUT 20 Coins PS$</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 100K</span> Safe FUT 20 Coins XBOX</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 200K</span> Safe FUT 20 Coins XBOX</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 300K</span> Safe FUT 20 Coins XBOX</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                ...
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-xbox" role="tabpanel" aria-labelledby="pills-xbox-tab">
                        <div class="form-inline" style="margin-top: 20px; margin-bottom: 20px;">
                            <label class="col-2">7 RESULTS</label>
                            <label class="col-6"></label>
                            <label class="col-2">Sort:</label>
                            <select id="inputState" class="form-control col-2">
                                <option selected>Highest Professions Level</option>
                                <option>Fastest Delivery</option>
                                <option>Highest Stock Level</option>
                                <option>Lowest Price</option>
                            </select>
                        </div>

                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 100K</span> Safe FUT 20 Coins PS4</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 200K</span> Safe FUT 20 Coins PS4</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 300K</span> Safe FUT 20 Coins PS4</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 400K</span> Safe FUT 20 Coins PS4</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 500K</span> Safe FUT 20 Coins PS$</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 100K</span> Safe FUT 20 Coins XBOX</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 200K</span> Safe FUT 20 Coins XBOX</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;"> 300K</span> Safe FUT 20 Coins XBOX</div>
                                    <div class="col-6 col-md-2 align-self-center">EUR € 9.87</div>
                                    <div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                ...
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </main>

@endsection

@section('my-js')
    <script>

        $('#unCategorySelect').change(function (event) {

            var category_id = $('#unCategorySelect option:selected').val();

            $.ajax({
                url: '/service/products/'+category_id,
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

                    $('#result').html(data.products.length+' RESULTS');
                    $('#productList').html('');

                    for(var i=0; i<data.products.length;i++){

                        var node = '<li class="list-group-item">'+
                            '<div class="row">'+
                            '<div class="col-sm-6 col-md-8 align-self-center"><i class="fas fa-coins" style="color: gold;"></i><span style="color: #ff253a;">'+
                            data.products[i].name+'</span>'+ data.products[i].summary+'</div>'+
                        '<div class="col-6 col-md-2 align-self-center">EUR € '+data.products[i].price+'</div>'+
                        '<div class="col-md-2"><button type="button" class="btn btn-outline-info">Buy now</button></div>'+
                        '</div>                        </li>';

                        $('#productList').append(node);
                    }


                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });

        });

    </script>



@endsection
