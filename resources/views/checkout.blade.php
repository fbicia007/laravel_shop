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
        <div class="container">
            <span>Home / checkout</span>
        </div>
        <div class="album py-5 bg-light">
            <div class="container" style="margin-top: -48px;">

                1
            </div>
        </div>


    </main>

@endsection

@section('my-js')

    <script>

    </script>

@endsection
