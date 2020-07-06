@extends('master')

@section('title','login')

@section('categoryMenu')
    @foreach($categorys as $category)
    <a class="dropdown-item" href="category/{{$category->id}}">{{$category->name}}</a>
    @endforeach
@endsection

@section('content')

<main role="main">
    <div id="categoryBanner" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#categoryBanner" data-slide-to="0" class="active"></li>
            <li data-target="#categoryBanner" data-slide-to="1"></li>
            <li data-target="#categoryBanner" data-slide-to="2"></li>
            <li data-target="#categoryBanner" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            @foreach($categorys as $category)
            <div class="carousel-item @if($category->id == 1) active @endif" onclick="location.href='category/{{$category->id}}';">
                <img src="/images/banner/{{$category->banner}}"  class="d-block w-100" >
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{$category->name}}</h5>
                    <p>{{$category->banner_text}}</p>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#categoryBanner" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#categoryBanner" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="album py-5 bg-light">


        <div class="container col-8">

            <h1></h1>
            <div class="row text-center">
                <h1 class="col"><i class="fab fa-playstation"></i></h1>
                <h1 class="col"><i class="fab fa-xbox"></i></h1>
                <h1 class="col"><i class="fab fa-steam"></i></h1>
                <h1 class="col"><i class="fab fa-battle-net"></i></h1>
            </div>

            <h1></h1>

            <div class="row">

                @foreach($categorys as $category)
                <div class="col text-center">
                    <div class="card shadow">
                        <img src="{{$category->preview}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$category->name}}</h5>
                            <p class="card-text">{{$category->info}}</p>
                            <a href="category/{{$category->id}}" class="btn btn-primary">See All</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</main>

@endsection

@section('footerList')
    @foreach($categorys as $category)
    <li><a class="text-muted" href="category/{{$category->id}}">{{$category->name}}</a></li>
    @endforeach
@endsection
