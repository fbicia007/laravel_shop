@extends('master')

@section('title','login')

@section('content')

<main role="main">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" onclick="location.href='fifa.php/';">
                <img src="https://via.placeholder.com/2000x500"  class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>FUT 20 COINS</h5>
                    <p>FIFA 20 Comfort Trade.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/2000x500" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>POE</h5>
                    <p>PATH OF EXILE Item and currency</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/2000x500" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>CS GO</h5>
                    <p>CS go Items & Skins.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/2000x500" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>WOW</h5>
                    <p>WOW Gold.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
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

                <div class="col text-center">
                    <div class="card shadow">
                        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">FUT 20</h5>
                            <p class="card-text">Buy FUT 20 coins with safe delivery on the best price with Comfort Trade for PS4 and XBOX One.</p>
                            <a href="fut.php" class="btn btn-primary">See All</a>
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="card shadow">
                        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">POE</h5>
                            <p class="card-text">Path of Exile currency and item selection with 10 minutes delivery. League selection is available!</p>
                            <a href="poe.php" class="btn btn-primary">See All</a>
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="card shadow">
                        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">CS go</h5>
                            <p class="card-text">Buy Counter-Strike: Global Offensive Items & Skins. Safe delivery</p>
                            <a href="csgo.php" class="btn btn-primary">See All</a>
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="card shadow">
                        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">WOW</h5>
                            <p class="card-text">Buy WoW Classic gold and return to Azeroth. Safe delivery awaits in WoW Vanilla.</p>
                            <a href="wow.php" class="btn btn-primary">See All</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</main>

@endsection