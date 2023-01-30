<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$seo->title}}</title>
    <meta name="description" content="{{$seo->description}}">
    <meta name="keywords" content="{{$seo->keywords}}">
    <link rel="shortcut icon" type="image/png" href="{{url('img/favicon.ico')}}">
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/animate.css')}}">
    <link rel="stylesheet" href="{{url('css/meanmenu.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{url('css/responsive.css')}}">
    @yield('styles')
</head>

<body>
    {{-- <div id="preloader"></div> --}}
    <header>
        <div class="menu-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-sm-12 col-12">
                        <div class="logo">
                        <a href="{{url('/')}}"><img src="{{url('img/logo.png')}}" alt="Kukulkan"></a>
                        </div>
                    </div>
                    
                    <div class="col-lg-7 offset-lg-0 col-md-8 offset-md-2 col-sm-12 offset-sm-0 col-12">
                        <div class="menu">
                            <nav id="mobile_menu_active">
                                <ul>
                                    <li class="active"><a href="{{url('/')}}">Home</a></li>
                                    <li><a href="{{url('about')}}">About Us</a></li>
                                    <li><a href="{{url('service', 'all')}}">Services</a></li>
                                    <li><a href="{{url('products')}}">Products</a></li>
                                    <li><a href="{{url('contact')}}">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-12 col-12">
                        <div class="search-consultant flexcenter">
                            <div class="sc-consultant">
                                <a class="link bg-secondary" href="{{url('apply-job')}}" target="_blank">Get Job</a>
                                <h6 class="text-center margint">For Candidates</h6>
                            </div>
                            <div class="sc-consultant">
                                <a class="link bg-secondary" href="{{url('post-job')}}" target="_blank">Post Job</a>
                                <h6 class="text-center margint">For Clients</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @if($seo->shortcode != 'home')
    <!-- breadcumb-area-start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb">
                        <h2 class="name">{{$seo->page}}</h2>
                        <ul class="links">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url($seo->shortcode)}}">{{$seo->page}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area-end -->
    @endif

    @yield('content')

    <?php
    foreach($config['contact_popup'] as $key => $contact_popup) {
        switch($contact_popup->shortcode) {
            case 'telephone-popup':
                $href = 'tel:'.$contact_popup->value;
                $icon = '<div class="fm-icon bg-popup_phone"></div>';
                break;
            case 'whatsapp-popup':
                $href = 'https://api.whatsapp.com/send?phone='.$contact_popup->value;
                $icon = '<div class="fm-icon bg-popup_whatsapp"></div>';
                break;
            default:
                $href = '';
                $icon = '';
        }
    ?>

    <a href="{{$href}}" target="_self">
        <?php echo $icon ?>
        <div class="fm-label"></div>
    </a>

    <?php } ?>

    <!-- footer-start -->
    <footer id="footer">
        <div class="footer-social-icons text-center">
            <h4>Follow Us</h4>
            <ul>
                <?php
                foreach($config['social_links'] as $key => $social_links) {
                    switch($social_links->shortcode) {
                        case 'facebook':
                            $icon = 'bg-facebook social-links-align';
                            break;
                        case 'twitter':
                            $icon = 'bg-twitter social-links-align';
                            break;
                        case 'instagram':
                            $icon = 'bg-instagram social-links-align';
                            break;
                        case 'linkedin':
                            $icon = 'bg-linkedin social-links-align';
                            break;
                        default:
                            $icon = '';
                    }
                ?>
                <li><a href="{{$social_links->value}}" target="_blank"><i class="{{$icon}}"></i></a></li>
                <?php } ?>
            </ul>
        </div>
        <p>© 2019 All Right Reserved Kukulkan<br>Designed by <a href="https://3pweb.in/" target="_blank"><b>3PWEB</b></a>
        </p>
    </footer>

    <script src="{{url('js/jquery-3.2.0.min.js')}}"></script>
    <script src="{{url('js/owl.carousel.min.js')}}"></script>
    <script src="{{url('js/jquery.meanmenu.js')}}"></script>
    <script src="{{url('js/jquery.waypoints.min.js')}}"></script>
    <script src="{{url('js/popper.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/theme.js')}}"></script>
    @yield('scripts')

    </body>

</html>