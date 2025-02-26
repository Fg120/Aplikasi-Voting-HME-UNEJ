<!DOCTYPE html>
<!-- saved from url=(0052)https://getbootstrap.com/docs/5.3/examples/carousel/ -->
<html lang="en" data-bs-theme="light">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="{{ asset('asset/home/color-modes.js.download') }}"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Home HME UNEJ</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">

    <link rel="stylesheet" href="{{ asset('asset/home/css@3') }}">

    <link href="{{ asset('asset/home/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('asset/logo-HME.png') }}">
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    {{-- <link rel="icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png"> --}}
    {{-- <link rel="icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png"> --}}
    <link rel="manifest" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    {{-- <link rel="icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon.ico"> --}}
    <meta name="theme-color" content="#712cf9">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="{{ asset('asset/home/carousel.css') }}" rel="stylesheet">
</head>

<body>
    @include('sweetalert::alert')
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 16 16">
            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path
                  d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z">
            </path>
            <path
                  d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z">
            </path>
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
            <path
                  d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z">
            </path>
        </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown"
                aria-label="Toggle theme (light)">
            <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                <use href="#sun-fill"></use>
            </svg>
            <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light" aria-pressed="true">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#sun-fill"></use>
                    </svg>
                    Light
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#moon-stars-fill"></use>
                    </svg>
                    Dark
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#circle-half"></use>
                    </svg>
                    Auto
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
        </ul>
    </div>


    <header data-bs-theme="dark">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home.index') }}">HME UNEJ</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        {{-- <li class="nav-item">
                            <a class="nav-link active"
                               aria-current="page"
                               href="https://getbootstrap.com/docs/5.3/examples/carousel/#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="https://getbootstrap.com/docs/5.3/examples/carousel/#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled"
                               aria-disabled="true">Disabled</a>
                        </li> --}}
                    </ul>
                    {{-- <form class="d-flex"
                          role="search">
                        <input class="form-control me-2"
                               type="search"
                               placeholder="Search"
                               aria-label="Search">
                        <button class="btn btn-outline-success"
                                type="submit">Search</button>
                    </form> --}}
                    <div class="d-flex">
                        <a href="{{ route('auth.logout') }}" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>

        {{-- <div id="myCarousel"
             class="carousel slide mb-6"
             data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button"
                        data-bs-target="#myCarousel"
                        data-bs-slide-to="0"
                        class="active"
                        aria-label="Slide 1"
                        aria-current="true"></button>
                <button type="button"
                        data-bs-target="#myCarousel"
                        data-bs-slide-to="1"
                        aria-label="Slide 2"
                        class=""></button>
                <button type="button"
                        data-bs-target="#myCarousel"
                        data-bs-slide-to="2"
                        aria-label="Slide 3"
                        class=""></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <svg class="bd-placeholder-img"
                         width="100%"
                         height="100%"
                         xmlns="http://www.w3.org/2000/svg"
                         aria-hidden="true"
                         preserveAspectRatio="xMidYMid slice"
                         focusable="false">
                        <rect width="100%"
                              height="100%"
                              fill="var(--bs-secondary-color)"></rect>
                    </svg>
                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1>Example headline.</h1>
                            <p class="opacity-75">Some representative placeholder content for the first slide of the carousel.</p>
                            <p><a class="btn btn-lg btn-primary"
                                   href="https://getbootstrap.com/docs/5.3/examples/carousel/#">Sign up today</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img"
                         width="100%"
                         height="100%"
                         xmlns="http://www.w3.org/2000/svg"
                         aria-hidden="true"
                         preserveAspectRatio="xMidYMid slice"
                         focusable="false">
                        <rect width="100%"
                              height="100%"
                              fill="var(--bs-secondary-color)"></rect>
                    </svg>
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Another example headline.</h1>
                            <p>Some representative placeholder content for the second slide of the carousel.</p>
                            <p><a class="btn btn-lg btn-primary"
                                   href="https://getbootstrap.com/docs/5.3/examples/carousel/#">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img"
                         width="100%"
                         height="100%"
                         xmlns="http://www.w3.org/2000/svg"
                         aria-hidden="true"
                         preserveAspectRatio="xMidYMid slice"
                         focusable="false">
                        <rect width="100%"
                              height="100%"
                              fill="var(--bs-secondary-color)"></rect>
                    </svg>
                    <div class="container">
                        <div class="carousel-caption text-end">
                            <h1>One more for good measure.</h1>
                            <p>Some representative placeholder content for the third slide of this carousel.</p>
                            <p><a class="btn btn-lg btn-primary"
                                   href="https://getbootstrap.com/docs/5.3/examples/carousel/#">Browse gallery</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev"
                    type="button"
                    data-bs-target="#myCarousel"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon"
                      aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next"
                    type="button"
                    data-bs-target="#myCarousel"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon"
                      aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div> --}}


        <!-- Marketing messaging and featurettes
  ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->
        <center>
            <h1 class="mt-3">Selamat Datang</h1>
        </center>
        <hr class="">

        <div class="container marketing">

            <!-- Three columns of text below the carousel -->
            <div class="row d-flex justify-content-center">
                @if ($settings->status == 1)

                    @if ($kandidats->count())
                        @foreach ($kandidats as $item)
                            <div class="col-lg-4">
                                <img src="{{ asset('storage/' . $item->foto) }}" height="300" width="300" class="bd-placeholder-img img-thumbnai object-fit-contain"
                                     alt="Foto {{ $item->nama }}">
                                <h2 class="fw-bold">Nomor Urut {{ $item->nomor }} </h2>
                                <h2 class="fw-normal">{{ $item->nama }}</h2>
                                @if ($item->visi != null)
                                    <h2>VISI :</h2>
                                    <p>{!! $item->visi !!}</p>
                                    <h2>MISI :</h2>
                                    <p>{!! $item->misi !!}</p>
                                @endif
                            </div><!-- /.col-lg-4 -->
                        @endforeach
                        <div class="col-12 d-flex justify-content-center">
                            @if ($status == 0)
                                <form action="{{ route('home.store') }}" method="post">
                                    @csrf
                                    <div class="input-group mb-3 shadow">
                                        <select required name="pilihan" class="form-select" id="inputGroupSelect02">
                                            <option value="" selected>Silahkan Pilih</option>
                                            @foreach ($kandidats as $item)
                                                <option value="{{ $item->id }}">{{ $item->id }}. {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </form>
                            @endif
                            @if ($status == 1)
                                <div class="card text-bg-danger mb-3" style="max-width: 20rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">ADMIN TIDAK DAPAT VOTING</h5>
                                    </div>
                                </div>
                                {{-- <h2>ADMIN TIDAK DAPAT VOTING</h2> --}}
                            @endif
                            @if ($status == 2)
                                <div class="card text-bg-info mb-3" style="max-width: 25rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">ANDA TELAH MELAKUKAN VOTING</h5>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <h1 class="d-flex justify-content-center mt-3">TIDAK ADA KANDIDAT</h1>
                    @endif
                @else
                    <h1 class="d-flex justify-content-center mt-3">BELUM WAKTUNYA MEMILIH</h1>
                @endif
            </div><!-- /.row -->

            <hr class="featurette-divider">

        </div><!-- /.container -->


        <!-- FOOTER -->
        <footer class="container">
            <p class="float-end"><a href="#">Back to top</a></p>
            <p>© HME UNEJ.</p>
        </footer>
    </main>
    <script src="{{ asset('asset/home/bootstrap.bundle.min.js.download') }}" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



</body>

</html>
