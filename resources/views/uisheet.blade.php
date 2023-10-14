<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>4KSI </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Premium Bootstrap 5 Template" />
    <meta name="keywords" content="bootstrap 5, premium, marketing, multipurpose" />
    <meta content="Themesdesign" name="author" />

    <!-- favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- tinyslider -->
    <link rel='stylesheet' href="{{ asset('assets_landing/css/tiny-slider.css') }}" />
    <link rel='stylesheet' href="{{ asset('assets_landing/css/bootstrap.min.css') }}" />
    <link rel='stylesheet' href="{{ asset('assets_landing/css/style.min.css') }}" />

    {{-- <link href="https://fonts.googleapis.com/css2?family=Moon+Dance&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" /> --}}


    <style>
        .navbar {
            background-color: #2A895B !important;
        }

        .navbar .nav-link {
            color: #fff !important;
        }

        body {
            font-family: montserrat;
        }

        .navbar-nav a {
            font-size: 15px;
            text-transform: uppercase;
            font-weight: 700;
            text-shadow: 0 2px 2px rgba(0, 0, 0, 0.5);
        }

        .navbar-light .navbar-brand {
            color: #fff;
            font-size: 25px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .navbar-light .navbar-brand:focus,
        .navbar-light .navbar-brand:hover {
            color: #fff;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-light .navbar-nav .nav-link:focus,
        .navbar-light .navbar-nav .nav-link:hover {
            color: yellow;
        }

        .navbar-toggler {
            padding: 1px 5px;
            font-size: 18px;
            line-height: 0.3;
            background: #fff;
        }

        /* carousel */

        .carousel-item {
            height: 100vh;
            min-height: 300px;
        }

        .bg-1 {
            background-image: url('{{ asset('assets_landing/images/b1.png') }}');

        }

        .bg-2 {
            background-image: url('{{ asset('assets_landing/images/b2.jpg') }}');

        }

        .bg-3 {
            background-image: url(img/3.jpg);
        }

        .bg-1,
        .bg-2,
        .bg-3 {
            -webkit-background-size: cover;
            background-size: cover;
        }

        .carousel-caption {
            bottom: 220px;
            z-index: 2;
        }

        .carousel-caption h5 {
            font-size: 85px;
            text-transform: capitalize;
            letter-spacing: 2px;
            margin-top: 25px;
            font-family: "Moon Dance", cursive;
        }

        .carousel-caption p {
            width: 60%;
            margin: auto;
            font-size: 18px;
            line-height: 1.9;
        }

        .carousel-caption a {
            text-transform: uppercase;
            text-decoration: none;
            padding: 5px 20px;
            display: inline-block;
            color: #fff;
            margin-top: 15px;
            border-radius: 5px;
        }

        .carousel-inner:before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .carousel-indicators {
            bottom: 65px;
        }

        .carousel-indicators button {
            width: 100px !important;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .navbar-nav {
                text-align: center;
            }

            .navbar-collapse {
                background: #fff;
            }

            .navbar-collapse .nav-item .nav-link {
                color: #000;
            }

            .carousel-caption {
                bottom: 350px;
            }

            .carousel-caption h5 {
                font-size: 65px;
            }

            .carousel-caption p {
                font-size: 18px;
                width: 100%;
            }
        }

        @media only screen and (max-width: 767px) {
            .navbar-nav {
                text-align: center;
            }

            .navbar-collapse .nav-item .nav-link {
                color: #000;
            }

            .carousel-caption {
                bottom: 165px;
            }

            .carousel-caption h5 {
                font-size: 25px;
            }

            .carousel-caption p {
                font-size: 12px;
                width: 100%;
            }

            .carousel-caption a {
                padding: 10px 15px;
                font-size: 15px;
            }

            .navbar-collapse {
                background: #fff;
            }
        }

    </style>


</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="67">



    {{-- new --}}
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="border:none;">
        <div class="container">
            <a class="navbar-brand" href="#"><span class="text-warning">4</span>DCAK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#feature">Latar Belakang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#service">Portofolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">Visi & Misi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ 'login' }}">
                            Masuk
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active bg-1"></div>
            <div class="carousel-item bg-2">

            </div>
            {{-- <div class="carousel-item bg-3">
                <div class="carousel-caption">
                    <h5>Effordable <span class="text-warning">Budget</span></h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Temporibus, culpa.
                    </p>
                    <a href="#" class="bg-warning text-white">Learn More</a>
                </div>
            </div> --}}
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

        <!--thumbnails-->

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">
                <img class="d-block w-100" src="{{ asset('assets_landing/images/b1.png') }}" class="img-fluid" />

            </button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2">
                <img class="d-block w-100" src="{{ asset('assets_landing/images/b2.jpg') }}" class="img-fluid" />
            </button>

        </div>
    </div>


    <!-- start feature -->
    <section class="section bg-light overflow-hidden" id="feature">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img class="img-container" src="{{ asset('assets_landing/images/chat.png') }}" alt="HJ. Abdul Khoir S.T" />
                </div>
                <div class="col-lg-6 mt-lg-0 mt-5 pt-lg-0 pt-4">
                    <h3 class="fw-semibold lh-base mb-4">
                        Profil Singkat <br />
                        HJ. Abdul Khoir S.T <br />
                    </h3>
                    <h5 class="text-muted fw-normal">Dedikasi, Integritas, dan Kemajuan untuk Anda.</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-4 border rounded mt-2">
                                <h5>Pendidikan Dasar & Menengah</h5>
                                <p class="text-muted">Dituntun oleh pendidikan yang berkualitas, mengukir dasar
                                    karakter
                                    yang kuat dan visioner.</p>
                            </div>
                            <div class="p-4 border rounded mt-2">
                                <h5>Pendidikan Tinggi</h5>
                                <p class="text-muted">Memperkuat fondasi pengetahuan dan kompetensi, berkontribusi
                                    untuk
                                    masyarakat yang lebih baik.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end feature -->

    <!-- start faq -->
    <section class="section border-top overflow-hidden" id="faq">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-12">
                    <h6 class="text-muted mb-3">Visi dan Misi</h6>
                    <h3 class="faq-title pb-4">HJ. Abdul Khoir S.T</h3>
                    <div class="accordion accordion-flush mt-4 pt-2" id="accordionFlushExample">
                        <div class="accordion-item my-2">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button text-start text-dark fw-medium ps-0 pb-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Can we put a lot of effort in design?
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-muted pt-3">
                                    High life accusamus terry richardson ad squid. 3 wolf moon
                                    officia aute, non cupidatat skateboard dolor brunch. Food
                                    truck quinoa nesciunt laborum eiusmod.It is a long
                                    established fact that a reader will be distracted by the
                                    readable.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item my-2">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button text-start text-dark fw-medium collapsed ps-0 pb-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    The most important of successful website?
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-muted pt-3">
                                    Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                    moon tempor, sunt aliqua put a bird on it squid
                                    single-origin coffee nulla assumenda shoreditch et.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item my-2">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button text-start text-dark fw-medium collapsed ps-0 pb-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    Submit Your Orgnization?
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-muted pt-3">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item my-2">
                            <h2 class="accordion-header" id="flush-headingSix">
                                <button class="accordion-button text-start text-dark fw-medium collapsed ps-0 pb-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                    New exhibition at our Museum?
                                </button>
                            </h2>
                            <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-muted pt-3">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-12">
                    <img class="faq-img mt-sm-0 mt-5" src="{{ asset('assets_landing/images/faq.png') }}" alt="" />
                </div>
            </div>
        </div>
    </section>
    <!-- end faq -->

    <!-- start services -->
    <section class="section bg-light" id="service">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-12 mb-4">
                    <h4 class="fw-semibold mb-3">Portofolio</h4>
                    <h5 class="text-muted fw-normal">Don't you get what you want?</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mt-4 pt-2">
                    <div class="service rounded px-4 py-md-5 py-3">
                        <div class="bg-info p-3 d-inline-block rounded-circle">
                            <i data-feather="users" class="text-white"></i>
                        </div>
                        <h6 class="my-4">Community</h6>
                        <p class="text-muted mb-4">
                            Some quick example text to build on the card title and make up
                            the bulk of the card's content. Moltin gives you the platform.
                        </p>

                    </div>
                </div>
                <div class="col-md-4 mt-4 pt-2">
                    <div class="service rounded px-4 py-md-5 py-3 active">
                        <div class="bg-warning p-3 d-inline-block rounded-circle">
                            <i data-feather="cast" class="text-white"></i>
                        </div>
                        <h6 class="my-4">Pre-approval</h6>
                        <p class="text-muted mb-4">
                            Some quick example text to build on the card title and make up
                            the bulk of the card's content. Moltin gives you the platform.
                        </p>

                    </div>
                </div>
                <div class="col-md-4 mt-4 pt-2">
                    <div class="service rounded px-4 py-md-5 py-3">
                        <div class="bg-danger p-3 d-inline-block rounded-circle">
                            <i data-feather="grid" class="text-white"></i>
                        </div>
                        <h6 class="my-4">Dashboard</h6>
                        <p class="text-muted mb-4">
                            Some quick example text to build on the card title and make up
                            the bulk of the card's content. Moltin gives you the platform.
                        </p>

                    </div>
                </div>
                <div class="col-md-4 mt-4 pt-2">
                    <div class="service rounded px-4 py-md-5 py-3">
                        <div class="bg-success p-3 d-inline-block rounded-circle">
                            <i data-feather="file" class="text-white"></i>
                        </div>
                        <h6 class="my-4">Reports</h6>
                        <p class="text-muted mb-4">
                            Some quick example text to build on the card title and make up
                            the bulk of the card's content. Moltin gives you the platform.
                        </p>

                    </div>
                </div>
                <div class="col-md-4 mt-4 pt-2">
                    <div class="service rounded px-4 py-md-5 py-3">
                        <div class="bg-secondary p-3 d-inline-block rounded-circle">
                            <i data-feather="droplet" class="text-white"></i>
                        </div>
                        <h6 class="my-4">Unlimited Colors</h6>
                        <p class="text-muted mb-4">
                            Some quick example text to build on the card title and make up
                            the bulk of the card's content. Moltin gives you the platform.
                        </p>

                    </div>
                </div>
                <div class="col-md-4 mt-4 pt-2">
                    <div class="service rounded px-4 py-md-5 py-3">
                        <div class="bg-dark p-3 d-inline-block rounded-circle">
                            <i data-feather="settings" class="text-white"></i>
                        </div>
                        <h6 class="my-4">Efficient</h6>
                        <p class="text-muted mb-4">
                            Some quick example text to build on the card title and make up
                            the bulk of the card's content. Moltin gives you the platform.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end servies -->
    </div>
    <!-- end-container -->
    </section>
    <!-- end brand logo -->

    <!-- start footer -->
    <footer class="footer bg-dark" style="display:none;">
        <!-- start footer alter -->
        <div class="footer-alt bg-dark">
            <div class="container">
                <div class="row text-center">
                    <div class="col-lg-12">
                        <script>
                            document.write(new Date().getFullYear());

                        </script>
                        &copy; by <a href="" class="text-muted">4KSI</a>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end footer alter -->

        <script src="{{ asset('assets_landing/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets_landing/js/feather.js') }}"></script>
        <script src="{{ asset('assets_landing/js/tiny-slider.js') }}"></script>
        <script src="{{ asset('assets_landing/js/tiny.init.js') }}"></script>
        <script src="{{ asset('assets_landing/js/app.js') }}"></script>
        <script src="{{ asset('assets_landing/js/text-animation.init.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

    </footer>
    <!-- end footer -->
