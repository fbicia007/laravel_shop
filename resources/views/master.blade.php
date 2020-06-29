<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="css/all.css" rel="stylesheet"> <!--load all styles -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>@yield('title')</title>
</head>
<body style="margin-top: 66px">


<header>
    <div class="navbar fixed-top navbar-expand navbar-dark flex-column flex-md-row bg-dark shadow">
        <div class="container">
            <!--<a class="navbar-brand" href="#">GameGoods</a>-->
            <a href="index.php">
                <img src="images/logo/logo-transparent.png" style="height: 50px;">
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
                            @yield('categoryMenu')
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sell to us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQ</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
                <a href="register" class="btn btn-dark my-2 my-sm-0" type="button" data-toggle="tooltip" data-placement="bottom" title="Sign Up"><i class="fas fa-user-plus"></i></a>
                <a href="login" class="btn btn-dark my-2 my-sm-0" type="button" data-toggle="tooltip" data-placement="bottom" title="Sign In"><i class="fas fa-user"></i></a>
                <button class="btn btn-dark my-2 my-sm-0" type="button" data-toggle="tooltip" data-placement="bottom" title="MY CART"><i class="fas fa-shopping-cart"></i></button>
            </div>
        </div>
    </div>
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
                <img class="mb-2" src="images/logo/logo-transparent.png" alt="" width="80">
                <small class="d-block mb-3 text-muted">&copy; 2019-2020</small>
            </div>
            <div class="col col-md">
                <h5>ABOUT</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">News</a></li>
                    <li><a class="text-muted" href="#">About Us</a></li>
                    <li><a class="text-muted" href="#">Sell to Us</a></li>
                </ul>
            </div>
            <div class="col col-md">
                <h5>PRODUCT</h5>
                <ul class="list-unstyled text-small">
                    @yield('footerList')
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
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

@yield('my-js')

</html>
