<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Login - Komisi Pemilihan Kahim">
    <meta name="keywords" content="Komisi Pemilihan Kahim, Login, ">
    <title>Login &mdash; Stisla</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('asset/logo-HME.png') }}">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    <style>
        @media (max-width: 768px) {
            .min-vh-100 {
                min-height: 75vh !important;
            }
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <div id="app">
        <section class="section">
            <div class="d-flex flex-wrap align-items-stretch">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="p-2 m-2">
                        <img src="{{ asset('asset/logo-HME.png') }}" alt="logo" height="75" class="mb-3 mt-2">
                        <img src="{{ asset('asset/logo-UNEJ.webp') }}" alt="logo" height="75" class="mb-3 mt-2">
                        <h5 class="text-dark font-weight-normal" style="font-family: 'Times New Roman';">Welcome to <br><span class="font-weight-bold">{{ config('app.name') }}</span></h5>
                        {{-- <p class="text-muted">Before you get started, you must login or register if you don't already have an account.</p> --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul style="margin: 0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                        @endif
                        <form method="POST" action="{{ route('auth.store') }}" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="nim">Nim</label>
                                <input id="nim" type="nim" class="form-control shadow" name="nim" value="{{ old('nim') }}" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                    Mohon isi nim anda!
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control shadow" name="password" tabindex="2" required>
                                <div class="invalid-feedback">
                                    Mohon isi password anda!
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="captcha" class="control-label">Captcha</label>
                                </div>
                                <div class="captcha">
                                    <span style="height: 50px; width: 120px">{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <input id="captcha" type="text" class="form-control shadow" placeholder="Isi Captcha" name="captcha" required>
                                <div class="invalid-feedback">
                                    Silahkan Isi Captcha
                                </div>
                            </div>
                            <div class="form-group text-right row">
                                {{-- <a href="auth-forgot-password.html" class="float-left mt-3">
                                    Forgot Password?
                                </a> --}}
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                        Login
                                    </button>
                                </div>
                                <div class="col-auto" style="font-size: 12px">
                                    <span class="row">If a problem occurs please contact:</span>
                                    <span class="row">class of 2021 085894439785 (Ima)</span>
                                    <span class="row">class of 2022 083102615229 (Angga)</span>
                                    <span class="row">class of 2023 0859117376866 (Luthfi)</span>
                                    <span class="row">Active Student 085936150188 (Daniel)</span>
                                </div>
                            </div>

                            {{-- <div class="mt-4 text-center">
                                <span>If a problem occurs please contact:</span>
                                <span>class of 2021 085894439785 (Ima)</span>
                                <span>class of 2022 083102615229 (Angga)</span>
                                <span>class of 2023 0859117376866 (Luthfi)</span>
                                <span>Active Student 085936150188 (Daniel)</span>
                            </div> --}}
                        </form>

                        {{-- <div class="text-center mt-5 text-small">
                            Copyright &copy; Your Company. Made with 💙 by Stisla
                            <div class="mt-2">
                                <a href="#">Privacy Policy</a>
                                <div class="bullet"></div>
                                <a href="#">Terms of Service</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-8 col-md-6 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
                     data-background="{{ asset('assets/img/bghme.jpg') }}">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                <h1 class="display-4 font-weight-bold">
                                    @php
                                        $hour = now()->format('H');
                                        if ($hour >= '01' && $hour < '10') {
                                            echo 'Good Morning';
                                        } elseif ($hour >= '10' && $hour < '15') {
                                            echo 'Good Afternoon';
                                        } elseif ($hour >= '15' && $hour < '19') {
                                            echo 'Good Evening';
                                        } elseif ($hour >= '19' || $hour < '01') {
                                            echo 'Good Night';
                                        }
                                    @endphp
                                </h1>
                                <h5 class="font-weight-normal text-muted-transparent">Jember, Indonesia</h5>
                            </div>
                            {{-- Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb" target="_blank"
                               href="https://unsplash.com">Unsplash</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script type="text/javascript">
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>

</body>

</html>
