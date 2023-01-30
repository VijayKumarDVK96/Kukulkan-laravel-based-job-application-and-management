@extends('includes.layout')

@section('styles')
    <link rel="stylesheet" href="{{url('css/owl.carousel.min.css')}}">
@endsection

@section('content')
<!-- slider-area-start -->
    <!-- carousel start -->
    <div id="demo" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{url('img/banner-1.jpg')}}" alt="banner-1">
            </div>
            <div class="carousel-item">
                <img src="{{url('img/banner-2.jpg')}}" alt="banner-2">
            </div>
            <div class="carousel-item">
                <img src="{{url('img/banner-3.jpg')}}" alt="banner-3">
            </div>
            <div class="carousel-item">
                <img src="{{url('img/banner-4.jpg')}}" alt="banner-4">
            </div>
            <div class="carousel-item">
                <img src="{{url('img/banner-5.jpg')}}" alt="banner-5">
            </div>
            <div class="carousel-item">
                <img src="{{url('img/banner-6.jpg')}}" alt="banner-6">
            </div>
            <div class="carousel-item">
                <img src="{{url('img/banner-7.jpg')}}" alt="banner-7">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
    <!-- carousel end -->

    <!-- slider-area-end -->
    <!--  about area start -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-12">
                <div class="section-title">
                    <h2>About Us</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <img src="{{url('img/about.jpg')}}" alt="about">
            </div>
            <div class="col-md-6">
                <p class="about">KUKULKAN is recruitment and staffing solutions consultant based at Madurai, Tamilnadu. We
                    are experts in this field with 13 years of experience, focusing on Southern India. We are your one stop
                    solution for all manpower requirements , from entry level to executive search, Permanent and temp
                    staffing, blue collar to contract labour, sales to service in Tamilnadu. We also provide candidates from
                    Tamilnadu for your recruitment requirements across India.
                </p>
                <div class="sc-consultant tc">
                <a class="link bg-secondary text-center" href="{{url('about')}}">View More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- about area end -->

    <!-- top-agency-area-start -->
    <div class="top-agency-area" id="_top_agency">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-12">
                    <div class="section-title">
                        <h2>Our Services</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="top-agencey-content">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <a href="{{url('service', 'recruitment')}}">
                                    <div class="single-top-agency">
                                        <div class="icon">
                                            <span class="bg-recruitement"></span>
                                        </div>
                                        <h6 class="name">Recruitment</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <a href="{{url('service', 'staffing')}}">
                                    <div class="single-top-agency">
                                        <div class="icon">
                                            <span class="bg-staff"></span>
                                        </div>
                                        <h6 class="name">Staffing</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <a href="{{url('service', 'training')}}">
                                    <div class="single-top-agency">
                                        <div class="icon">
                                            <span class="bg-training"></span>
                                        </div>
                                        <h6 class="name">Training and Development</h6>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- top-agency-area-end -->

    <div class="row">
        <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-12">
            <div class="section-title">
                <h2>Contact US</h2>
            </div>
        </div>
    </div>

    <!-- contact-details-area-start -->
    <div class="contact-details-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="all-contact-details all-contact-details-home">
                        <div class="row">
                            <div class="col-lg-1">
                            </div>
                            <?php
                                foreach($contact_details as $contact) {
                                    if($contact->type == 'Contact Details') {
                                        switch($contact->shortcode) {
                                            case 'our-address':
                                                $icons = 'bg-location';
                                                break;
                                            case 'email-address':
                                                $icons = 'bg-mail';
                                                break;
                                            case 'contact':
                                                $icons = 'bg-contact';
                                                break;
                                            case 'call-and-whatsapp':
                                                $icons = 'bg-call-and-whatsapp';
                                                break;
                                            case 'office-hours':
                                                $icons = 'bg-office-hours';
                                                break;
                                            default:
                                                $icons = '';
                                        }
                            ?>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="single-contact-details">
                                    <div class="icon">
                                        <span class="{{$icons}}"></span>
                                    </div>
                                    <h4 class="title">{{$contact->name}}</h4>
                                    <?php echo $contact->value; ?>
                                </div>
                            </div>
                            <?php
                                } }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact-details-area-end -->
@endsection

@section('scripts')
    <script>
        $(".carousel-inner").carousel({interval:5000,pause:false});
    </script>
@endsection