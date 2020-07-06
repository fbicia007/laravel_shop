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

{{$product[0]->id}}

{{$product[0]->price}}
{{$product[0]->preview}}
{{$product[0]->category_id}}
{{$product[0]->platform}}

<main role="main">
    <div class="container">
        <span>Home / OnlineGames / {{$product[0]->name}}</span>
    </div>
    <div class="album py-5 bg-light">
        <div class="container" style="margin-top: -48px;">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="..." class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{$product[0]->name}}</h5>
                            <p class="card-text">{{$product[0]->summary}}</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>


@endsection

@section('my-js')




@endsection
