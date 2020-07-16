@extends('master')

@section('title','category')

@section('categoryMenu')
    @foreach($categorys as $category)
        <a class="dropdown-item" href="/category/{{$category->id}}">{{$category->name}}</a>
    @endforeach
@endsection

@section('footerList')
    @foreach($categorys as $category)
        <li><a class="text-muted" href="/category/{{$category->id}}">{{$category->name}}</a></li>
    @endforeach
@endsection

@section('content')


    <main role="main">
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row text-center">
                    <div class="col-sm text-secondary"><h6>1 SHOPPING CART</h6></div>
                    <div class="col-sm"><h6> > </h6></div>
                    <div class="col-sm"><h6>2 ORDER INFORMATION</h6></div>
                    <div class="col-sm"><h6> > </h6></div>
                    <div class="col-sm text-secondary"><h6>3 COMPLETE PAYMENT</h6></div>
                </div>

                @foreach($cart_items as $cart_item)
                    @if($cart_item->special_infos != null)
                        @foreach(explode(",",$cart_item->special_infos) as $special_info)
                            <div class="container">
                                <div class="form-group">
                                    <label>{{$special_info}}</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach

            </div>
        </div>


    </main>

@endsection

@section('my-js')

    <script>

    </script>

@endsection
