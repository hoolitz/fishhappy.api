<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fish Happy</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/vendor/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/vendor/device-mockups/device-mockups.min.css') }}">

    <!-- Theme CSS -->
    <link href="{{ asset('frontend/css/new-age.css') }}" rel="stylesheet">

    <style>
        body.lock{
            overflow: hidden;
        }
        .layout{
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
        }
        .center{
            -ms-align-items: center;
            align-items: center;
        }
        .center-center{
            -ms-align-items: center;
            align-items: center;
            justify-content: center;
        }
        #ytLarge{
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: black; z-index: 9999; display: flex; -ms-align-items: center; align-items: center; justify-content: center;

            -webkit-transition: all 0.35s ease-out;
            -o-transition: all 0.35s ease-out;
            transition: all 0.35s ease-out;
        }
        #ytLarge:not(.open){
            opacity: 0;
            pointer-events: none;

            -webkit-transform: scale(0.95);
            -ms-transform: scale(0.95);
            -o-transform: scale(0.95);
            transform: scale(0.95);
        }
        #ytBanner{
            position: fixed; top: 0; left: 0; width: 100%; height: 60px; background: #000; color: #f3f3f3;
            -ms-align-items: center; align-items: center; padding-left: 20px;

            -webkit-transform: translateY(-100%);
            -ms-transform: translateY(-100%);
            -o-transform: translateY(-100%);
            transform: translateY(-100%);

            -webkit-transition: transform 0.35s ease-out;
            -o-transition: transform 0.35s ease-out;
            transition: transform 0.35s ease-out;
        }

        #ytLarge:hover #ytBanner{
            -webkit-transform: none;
            -ms-transform: none;
            -o-transform: none;
            transform: none;
        }
        #ytCloser{
            background: rgba(255, 255, 255, 0.1); border: none; padding: 10px; margin-right: 12px
        }
    </style>

</head>

<body id="page-top">

<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">Fish Happy</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="page-scroll" href="#download">Download</a>
                </li>
                <li>
                    <a class="page-scroll" href="#features">Features</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-content">
                    <div class="header-content-inner">
                        <h1>
                            Fish Happy is a handy little app that can help you keep your fish info and order, you want that right?
                        </h1>
                        <!-- <h1>New Age is an app landing page that will help you beautifully showcase your new mobile app, or anything else!</h1> -->
                        <a href="#download" class="btn btn-outline btn-xl page-scroll">Start Now for Free!</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="device-container">
                    <div class="device-mockup galaxy_s5 portrait white">
                        <div class="device">
                            <div class="screen">
                                <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                                <img src="{{ asset('frontend/img/pic1.png') }}" class="img-responsive" alt="">
                            </div>
                            <div class="button">
                                <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="download" class="download bg-primary text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2 class="section-heading">Discover what all the buzz is about!</h2>
                <p>Our app is available on any android device! Download now to get started!</p>
                <div class="badges">
                    <a class="badge-link" href="https://play.google.com/store/apps/details?id=tz.co.fishhappy.app">
                        <img src="{{ asset('frontend/img/google-play-badge.svg') }}" alt=""></a>
                    <!-- <a class="badge-link" href="#"><img src="img/app-store-badge.svg" alt=""></a> -->
                </div>
            </div>
        </div>
    </div>
</section>

<section id="features" class="features">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-heading">
                    <h2>Cool Features, nice &amp; Fun</h2>
                    <p class="text-muted">Check out what you can do with this app theme!</p>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="device-container">
                    <div class="device-mockup galaxy_s5 portrait white">
                        <div class="device">
                            <div class="screen">
                                <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                                <img src="{{ asset('frontend/img/pic2.png') }}" class="img-responsive" alt="">
                            </div>
                            <div class="button">
                                <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="feature-item">
                                <i class="icon-basket text-primary"></i>
                                <h3>Order from wherever</h3>
                                <p class="text-muted">
                                    From home or work, place an order and it will be delivered to you.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-item">
                                <i class="icon-info text-primary"></i>
                                <h3>Get Informed</h3>
                                <p class="text-muted">Fish Happy gives you more information about the fish you love.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="feature-item">
                                <i class="icon-heart text-primary"></i>
                                <h3>Reorder favorites</h3>
                                <p class="text-muted">
                                    Have the same order as before, favorite it and it'll be closer.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-item">
                                <i class="icon-present text-primary"></i>
                                <h3>Free to Use</h3>
                                <p class="text-muted">Fish Happy is given to you for free, so if you like it, buy us coffee!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta">
    <div class="cta-content">
        <div class="container">
            <h2>Stop waiting.<br>Get moving.</h2>
            <a href="#download" class="btn btn-outline btn-xl page-scroll">Let's Get Started!</a>
        </div>
    </div>
    <div class="overlay"></div>
</section>

<section id="contact" class="contact bg-primary">
    <div class="container">
        <h2>We <i class="fa fa-heart"></i> new friends!</h2>
        <ul class="list-inline list-social">
            <li class="social-twitter">
                <a href="https://www.twitter.com/fishhappy_info"><i class="fa fa-twitter"></i></a>
            </li>
            <li class="social-facebook">
                <a href="https://www.facebook.com/search/pages/?q=Fish%20Happy"><i class="fa fa-facebook"></i></a>
            </li>
            <li class="social-instagram">
                <a href="https://www.instagram.com/fishhappytz"
                   style="background: #121b26"><i class="fa fa-instagram"></i></a>
            </li>
        </ul>
    </div>
</section>

<footer>
    <div class="container">
        <p>&copy; 2017 Fish Happy. All Rights Reserved.</p>
        <ul class="list-inline">
            <li><a href="#">Privacy</a></li>
            <li><a href="terms.html">Terms</a></li>
            <li><a href="#">FAQ</a></li>
        </ul>
    </div>
</footer>

<div id="ytLarge" class="layout center-center" style="display: none;">
    <div id="ytBanner" class="layout center">
        <button onclick="closeYtPreview()" id="ytCloser" class="layout center-center">
            <i class="icon-arrow-left" style="color: #fff; font-size: 17px"></i>
        </button> <span style="font-size: 21px; font-family: verdana">Fish Happy</span>
    </div>

    <iframe id="ytIframe" src="http://www.youtube.com/embed/W7qWa52k-nE" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
</div>

<!-- jQuery -->
<script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<!-- Theme JavaScript -->
<script src="{{ asset('frontend/js/new-age.min.js') }}"></script>
<script>
    var div = document.getElementById("ytLarge");
    var iframe = div.getElementsByTagName("iframe")[0].contentWindow;
    // var iframe = document.getElementById('ytIframe').contentWindow;
    console.log(iframe);

    function closeYtPreview(){
        document.getElementById("ytLarge").classList.remove("open");
        document.body.classList.remove("lock");
        toggleYtV('pauseVideo');
    }

    function openYtPreview(){
        document.getElementById("ytLarge").classList.add("open");
        document.body.classList.add("lock");
        toggleYtV('playVideo');
    }

    function toggleYtV(func){
        iframe.postMessage('{"event":"command","func":"' + func + '","args":""}', '*');
    }
</script>

</body>
</html>
