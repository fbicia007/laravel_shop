@extends('master')

@section('title','login')


@section('content')

<main role="main">
    <div id="categoryBanner" class="carousel slide" data-ride="carousel">
        <!--<ol class="carousel-indicators">
            <li data-target="#categoryBanner" data-slide-to="0" class="active"></li>
            <li data-target="#categoryBanner" data-slide-to="1"></li>
            <li data-target="#categoryBanner" data-slide-to="2"></li>
            <li data-target="#categoryBanner" data-slide-to="3"></li>
        </ol>-->
        <div class="carousel-inner">
            @foreach($categories as $category)
                @if($category->banner != null)
            <div class="carousel-item @if($category->id == 1) active @endif" onclick="location.href='category/{{$category->id}}';">
                <img src="{{$category->banner}}"  class="d-block w-100" >
            <!--
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{$category->name}}</h5>
                    <p>{{$category->banner_text}}</p>
                </div>
                -->
            </div>
                @endif
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

            <div class="row">

                @foreach($categories as $category)
                <div class="col-sm text-center">
                    <div class="card shadow">
                        <!--<a href="category/{{$category->id}}" data-toggle="tooltip" data-placement="right" title="{{$category->info}}">-->
                        <a href="category/{{$category->id}}">
                            <img src="{{$category->preview}}" class="card-img-top">
                        </a>
                    <!--
                        <div class="card-body">
                            <h4 class="card-title">{{$category->name}}</h4>
                        </div>
                        -->
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</main>
@endsection

@section('my-js')

@endsection
