<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Stabig - Responsive Landing page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Premium Bootstrap 5 Template" />
    <meta name="keywords" content="bootstrap 5, premium, marketing, multipurpose" />
    <meta content="Themesdesign" name="author" />

    <!-- favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- tinyslider -->
    <link rel='stylesheet' href="{{asset('assets_landing/css/tiny-slider.css')}}" />
    <link rel='stylesheet' href="{{asset('assets_landing/css/bootstrap.min.css')}}" />
    <link rel='stylesheet' href="{{asset('assets_landing/css/style.min.css')}}" />

    <style>
        .navbar {
            background-color: #50c594 !important;
        }

        .navbar .nav-link {
            color: #fff !important;
        }

    </style>

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="67">
    <!-- start navbar -->
    <nav class="navbar navbar-expand-lg fixed-top sticky" id="navbar">
        <div class="container">
            <a href="layout-1.html" class="navbar-brand me-5">
                <img src="{{ asset('assets_landing/images/logo-dark.png') }}" class="logo-dark" alt="" height="22" />
            </a>
            <a href="javascript:void(0)" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggle-icon"><i data-feather="menu"></i></span>
            </a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav navbar-center me-auto mt-lg-0 mt-2">
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
                        <a class="nav-link" href="#client">Guru</a>
                    </li>
                    <li class="nav-item" style="position: absolute;right: 0;margin-right: 12vh;">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Masuk
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end container -->
    </nav>
    <!-- end navbar -->

    @yield('content')



    <!-- start footer -->
    <footer class="footer bg-dark">

    </footer>
    <!-- end footer -->

    <!-- start footer alter -->
    <div class="footer-alt bg-dark">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <script>
                        document.write(new Date().getFullYear());

                    </script>
                    &copy; Stabig by <a href="" class="text-muted">Themesdesign</a>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end footer alter -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Masuk sebagai penginput data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- Pesan Error (jika ada) -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first('message') }}
                    </div>
                    @endif

                    <!-- Form Login -->
                    <form action="{{ route('loginProcess') }}" method="post">
                        @csrf
                        <span id="error-msg"></span>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <!-- Username -->
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-medium form-label" for="username">Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="Masukan username" id="username" required />
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-medium form-label" for="Password">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Your Password" id="Password" required />
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12">
                                        <input type="submit" id="submit" name="send" class="btn btn-primary mt-2" value="Kirim" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- end modal -->

    <script src="{{asset('assets_landing/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{asset('assets_landing/js/feather.js') }}"></script>
    <script src="{{asset('assets_landing/js/tiny-slider.js') }}"></script>
    <script src="{{asset('assets_landing/js/tiny.init.js') }}"></script>
    <script src="{{asset('assets_landing/js/app.js') }}"></script>
    <script src="{{asset('assets_landing/js/text-animation.init.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

</body>
</html>
