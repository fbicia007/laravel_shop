<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="/css/all.css" rel="stylesheet"> <!--load all styles -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/myCss.css">

    <title>MMOZONE Gaming Shop</title>
    <meta name="keywords" content="MMOZONE Gaming Shop">
    <meta name="description" content="MMZONE Gaming Shop, FIFA20,FIFA21,FIFAFut">
</head>
<body style="margin-top: 66px">


<header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark flex-column flex-md-row bg-dark shadow">
        <div class="container">
            <!--<a class="navbar-brand" href="#">GameGoods</a>-->
            <a href="/">
                <img src="/images/logo/logo-transparent.png" style="height: 50px;">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            OnlineGames
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($categories as $category)
                                <a class="dropdown-item" href="/category/{{$category->id}}">{{$category->name}}</a>
                            @endforeach
                        </div>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sell to us</a>
                    </li>
                    -->
                    <li class="nav-item">
                        <a class="nav-link" href="/contact_us">Contact Us</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="get" action="/search">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
                    @if(!isset($member->email))
                    <a href="/register" class="btn btn-dark my-2 my-sm-0" type="button" data-toggle="tooltip" data-placement="bottom" title="Sign Up"><i class="fas fa-user-plus"></i></a>
                    @endif

                <div class="btn-group">

                    @if(isset($member->email))
                    <a href="#" class="btn btn-dark my-2 my-sm-0 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="Sign In"><i class="fas fa-user"></i></a>
                    @else
                    <a href="/login" class="btn btn-dark my-2 my-sm-0" type="button"  aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="Sign In"><i class="fas fa-user"></i></a>
                    @endif
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/overview">MY ACCOUNT</a>
                        <a class="dropdown-item" onclick="logout()">SIGN OUT</a>

                    </div>
                </div>
                @if($cartCount != null)
                <button class="btn btn-dark my-2 my-sm-0" type="button" data-toggle="tooltip" data-placement="bottom" title="MY CART" onclick="toCart()">
                    <i class="fas fa-shopping-cart"></i>
                    <span class='badge badge-warning' id='cartCount'>{{$cartCount}}</span>
                </button>
                @else
                <button class="btn btn-dark my-2 my-sm-0" type="button" data-toggle="tooltip" data-placement="bottom" title="MY CART" onclick="toCart()">
                    <i class="fas fa-shopping-cart"></i>
                    <span class='badge badge-warning' id='cartCount'></span>
                </button>
                    @endif

            </div>
        </div>
    </nav>
</header>

<!-- Modal -->
<div class="modal fade" id="errorMessage" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header">

            </div>
            <div class="modal-body">
                <span></span>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
@yield('content')


<footer class="text-muted pt-4 pt-md-5 border-top">
    <div class="container">

        <div class="row">
            <div class="col-12 col-md">
                <img class="mb-2" src="/images/logo/logo-transparent.png" alt="" width="80">
                <small class="d-block mb-3 text-muted">&copy; 2019-2020</small>
            </div>
            <div class="col col-md">
                <h5>ABOUT</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="/terms_conditions">Terms and Conditions</a></li>
                    <li><a class="text-muted" href="/privacy_policy">Privacy Policy</a></li>
                    <!--<li><a class="text-muted" href="#">Sell to Us</a></li>-->
                </ul>
            </div>
            <div class="col col-md">
                <h5>PRODUCT</h5>
                <ul class="list-unstyled text-small">
                    @foreach($categories as $category)
                        <li><a class="text-muted" href="/category/{{$category->id}}">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col col-md">
                <h5>FOLLOW US</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#"><i class="fab fa-youtube-square"></i> YouTube</a></li>
                    <li><a class="text-muted" href="#"><i class="fab fa-twitter-square"></i> Twitter</a></li>
                    <li><a class="text-muted" href="#"><i class="fab fa-facebook-square"></i> FaceBook</a></li>
                </ul>
            </div>
            <div class="col col-md">
                <h5>CONTACT US</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#"><i class="fas fa-envelope"></i> service@xxx.com</a></li>
                    <li><a class="text-muted" href="#"><i class="fab fa-skype"></i> Skype:xxx</a></li>
                    <li><a class="text-muted" href="#"><i class="fab fa-whatsapp"></i> WhatsApp:xxxx</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

</body>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="/js/jquery-3.4.1.slim.min.js"></script>
<script src="/js/jquery-3.5.1.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    function toCart() {
        location.href='/cart';
    }

    function logout() {

        $.ajax({
            url: '/service/logout',
            dataType: 'json',
            type: "POST",
            cache: false,
            data: {_token:"{{csrf_token()}}"},
            success:function(data) {
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
            },
                error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
        setTimeout(function(){ location.href = "/"; }, 1000);
    }

</script>

@yield('my-js')

</html>
