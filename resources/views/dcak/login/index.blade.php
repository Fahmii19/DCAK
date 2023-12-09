<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login DCAK</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('asset-login-dcak/images/icons/favicon.ico') }}" />

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-login-dcak/vendor/bootstrap/css/bootstrap.min.css') }}" />

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset-login-dcak/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" />

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset-login-dcak/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}" />

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-login-dcak/vendor/animate/animate.css') }}" />

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset-login-dcak/vendor/css-hamburgers/hamburgers.min.css') }}" />

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset-login-dcak/vendor/animsition/css/animsition.min.css') }}" />

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-login-dcak/vendor/select2/select2.min.css') }}" />

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset-login-dcak/vendor/daterangepicker/daterangepicker.css') }}" />

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-login-dcak/css/util.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('asset-login-dcak/css/main.css') }}" />

    <!--===============================================================================================-->
</head>

<body style="background-color: #666666">
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="{{ route('loginProcessAdmin') }}" method="POST">

                    @csrf
                    <span class="login100-form-title p-b-43">
                        Login 4KSI
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <input class="input100" type="text" name="username" required />
                        <span class="focus-input100"></span>
                        <span class="label-input100">Username</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" required />
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">Masuk</button>
                    </div>
                </form>



                <div class="login100-more"
                    style="background-image: url('{{ asset('assets_landing/images/bg.jpg') }}')"></div>

            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="{{ asset('asset-login-dcak/vendor/jquery/jquery-3.2.1.min.js') }}"></script>

    <!--===============================================================================================-->
    <script src="{{ asset('asset-login-dcak/vendor/animsition/js/animsition.min.js') }}"></script>

    <!--===============================================================================================-->
    <script src="{{ asset('asset-login-dcak/vendor/bootstrap/js/popper.js') }}"></script>

    <script src="{{ asset('asset-login-dcak/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!--===============================================================================================-->
    <script src="{{ asset('asset-login-dcak/vendor/select2/select2.min.js') }}"></script>

    <!--===============================================================================================-->
    <script src="{{ asset('asset-login-dcak/vendor/daterangepicker/moment.min.js') }}"></script>

    <script src="{{ asset('asset-login-dcak/vendor/daterangepicker/daterangepicker.js') }}"></script>

    <!--===============================================================================================-->
    <script src="{{ asset('asset-login-dcak/vendor/countdowntime/countdowntime.js') }}"></script>

    <!--===============================================================================================-->
    <script src="{{ asset('asset-login-dcak/js/main.js') }}"></script>

</body>

</html>
