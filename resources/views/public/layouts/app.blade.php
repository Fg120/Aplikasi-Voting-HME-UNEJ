<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('asset/logo-HME.png') }}" type="">

    <title> Voting - HME </title>

    @include('public.layouts.css')

    <style>
        .countdown {
            margin-bottom: 40px;
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            justify-content: center;
        }

        /* @media only screen and (max-width: 1024px) {
            .countdown {
                justify-content: center;
            }
        } */

        .countdown .time {
            display: flex;
            flex-direction: column;
            justify-content: start;
        }

        .countdown .time:not(:last-child) {
            margin-right: 16px;
        }

        .countdown .time #days,
        .countdown .time #hours,
        .countdown .time #minutes,
        .countdown .time #seconds,
        .countdown .time .semicolon {
            font-family: Samsung Sharp Sans;
            font-style: normal;
            font-weight: bold;
            letter-spacing: 0.3px;
        }

        @media only screen and (min-width: 1024px) {

            .countdown .time #days,
            .countdown .time #hours,
            .countdown .time #minutes,
            .countdown .time #seconds,
            .countdown .time .semicolon {
                font-size: 72px;
                line-height: 91px;
            }
        }

        @media only screen and (max-width: 1024px) {

            .countdown .time #days,
            .countdown .time #hours,
            .countdown .time #minutes,
            .countdown .time #seconds,
            .countdown .time .semicolon {
                font-size: 40px;
                line-height: 50px;
                text-align: center;
            }
        }

        .countdown .time span {
            font-family: Samsung Sharp Sans;
            font-style: normal;
            font-weight: normal;
            font-size: 12px;
            line-height: 15px;
            text-align: center;
            letter-spacing: 0.3px;
            align-self: center;
        }

        .countdown .semicolon {
            margin-right: 16px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            font-family: Samsung Sharp Sans;
            font-style: normal;
            font-weight: bold;
            letter-spacing: 0.3px;
        }

        @media only screen and (min-width: 1024px) {
            .countdown .semicolon {
                font-size: 72px;
                line-height: 91px;
            }
        }

        @media only screen and (max-width: 1024px) {
            .countdown .semicolon {
                font-size: 40px;
                line-height: 50px;
                text-align: center;
            }
        }

        .roman{
            font-family: 'Times New Roman';
        }
    </style>
</head>

<body>

    <div class="hero_area">
        <div class="bg-box" style="">
            <img src="{{ asset('asset/header2.webp') }}" alt="">
            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle, rgba(0, 0, 0, 0.3) 10%, rgba(0, 0, 0, 0.7) 100%); pointer-events: none;"></div>
        </div>
        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="{{ route('home.index') }}" style="color: white">
                        <h2 class="roman">
                            <b>Komisi Pemilihan Kahim</b>
                        </h2>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  ml-auto ">
                            {{-- <li class="nav-item active">
                                <a class="nav-link" href="{{ route('home.index') }}">Home <span class="sr-only">(current)</span></a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#">Voting</a>
                            </li> --}}
                        </ul>
                        <div class="user_option">
                            @can('dashboard view')
                                <a href="{{ route('admin.dashboard') }}" class="logout">
                                    Dashboard
                                </a>
                            @endcan
                            <a href="{{ route('auth.logout') }}" class="logout">
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
        <!-- slider section -->
        <section class="slider_section ">
            <div id="customCarousel1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7 col-lg-6 ">
                                    <div class="detail-box">
                                        <h2 class="roman">
                                            Halo {{ Auth::user()->nama }}
                                        </h2>
                                        <p class="roman">
                                            Jangan lewatkan kesempatan untuk memilih pemimpin terbaik yang siap membawa Fakultas Teknik menuju perubahan dan kemajuan.
                                        </p>
                                        <p class="roman"> Yuk, gunakan hak pilihmu sekarang!</p>
                                        <div class="btn-box">
                                            <a href="#daftar-kandidat" class="btn1">
                                                Lihat Kandidat
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end slider section -->
    </div>

    <!-- food section -->
    @php
        $show = 0;
        $dates = json_decode($settings->json, true);

        if ($settings->status == 0) {
            $show = 0;
        } elseif ($settings->status == 1) {
            $show = 2;
        } elseif ($settings->status == 2) {
            if (Carbon\Carbon::now()->isBefore($dates['start_date'])) {
                $show = 1;
            } elseif (Carbon\Carbon::now()->isBetween($dates['start_date'], $dates['end_date'])) {
                $show = 2;
            } elseif (Carbon\Carbon::now()->isAfter($dates['end_date'])) {
                $show = 3;
            }
        }

    @endphp

    <section class="food_section layout_padding-bottom mt-5" id="daftar-kandidat">
        @if ($show == 0)
            <div class="row justify-content-center">
                <div class="col-sm-6 card border-light shadow">
                    <div class="card-body">
                        <h3 class="text-center" style="font-weight: 600">Voting Belum Dimulai</h3>
                    </div>
                </div>
            </div>
        @elseif ($show == 1)
            <div class="row justify-content-center">
                <div class="col-sm-6 card border-light shadow-lg">
                    <div class="card-body">
                        <h3 class="text-center" style="font-weight: 600">Voting akan dimulai dalam</h3>
                        <div class="countdown">
                            <div class="time">
                                <span id="days">00</span>
                                <span>Hari</span>
                            </div>
                            <div class="semicolon">:</div>
                            <div class="time">
                                <span id="hours">00</span>
                                <span>Jam</span>
                            </div>
                            <div class="semicolon">:</div>
                            <div class="time">
                                <span id="minutes">00</span>
                                <span>Menit</span>
                            </div>
                            <div class="semicolon">:</div>
                            <div class="time">
                                <span id="seconds">00</span>
                                <span>Detik</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($show == 3)
            <div class="row justify-content-center">
                <div class="col-sm-6 card border-light shadow">
                    <div class="card-body">
                        <h3 class="text-center" style="font-weight: 600">Voting Telah Berakhir</h3>
                        @if (Auth::user()->is_vote == 1)
                            <h3 class="text-center" style="font-weight: 600">Terimakasih Atas Partisipasi Anda!</h3>
                        @endif
                    </div>
                </div>
            </div>
        @elseif($show == 2)
            <div class="container" style="left: min(20px, 5%);">
                <div class="heading_container heading_center">
                    <h2 class="roman">Daftar Kandidat</h2>
                </div>

                @if ($kandidats->count())
                    <div class="row justify-content-around mx-1">
                        @foreach ($kandidats as $item)
                            <div class="col-lg-5 all pizza p-0">
                                <div class="box shadow">
                                    <div>
                                        <div class="img-box p-0" style="justify-content: start">
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="foto {{ $item->nama }}" style="max-height: 100%; aspect-ratio: 3 / 4; left: 0; border-radius: 0 0 0 45px;">
                                            <h3 style="padding-left: 20px; padding-right: 20px ;color: black">{{ $item->nama }}</h3>
                                            <div style="font-size: 20px; font-weight: 600">
                                                <div style="position: absolute; top: 0; right: 0; background-color: #222831; border-radius: 0 0 0 15px; width: 140px; height: 40px; right: 40px">
                                                    <span style="position: absolute; top: 50%; transform: translate(0%, -50%); padding: 10px;">Nomor Urut</span>
                                                </div>
                                                <div style="position: absolute; top: 0; right: 0; background-color: #ffbe33; width: 40px; height: 40px;">
                                                    <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 10px;">{{ $item->nomor }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="detail-box">
                                            <h5>VISI</h5>
                                            <span>{!! $item->visi !!}</span>
                                            <h5>MISI</h5>
                                            <span>{!! $item->misi !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="row justify-content-center">
                        <div class="col-sm-6 card border-light shadow">
                            <div class="card-body">
                                <h3 class="text-center" style="font-weight: 600">Tidak Ada Kandidat!</h3>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- <div class="btn-box">
                <a href="">
                    Vote
                </a>
            </div> --}}
            </div>

            <div class="container mt-5">
                <div class="heading_container heading_center">
                    <h2 class="roman">Voting</h2>
                </div>

                <div class="row justify-content-center">
                    <div class="col-sm-6">
                        <div class="card border-light shadow">
                            <div class="card-body">
                                @can('voting vote')
                                    @if (Auth::user()->is_vote == 1)
                                        <h5 style="font-weight: 600">
                                            Terimakasih Atas Partisipasi Anda!
                                        </h5>
                                        <div class="alert alert-danger" role="alert">
                                            Anda Telah Melakukan Voting!
                                        </div>
                                    @else
                                        <form action="{{ route('voting.store') }}" method="POST">
                                            @csrf
                                            <select name="pilihan" class="form-select form-select-lg wide" aria-label="Form Pemilihan Kandidat" style="width: 100%" required>
                                                <option selected>Silahkan Pilih Kandidat</option>
                                                @foreach ($kandidats as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nomor }}. {{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-success mt-3">Submit</button>
                                        </form>
                                    @endif
                                @else
                                    <form action="#">
                                        <select class="form-select form-select-lg wide" aria-label="Form Pemilihan Kandidat" style="width: 100%" required>
                                            <option selected>Silahkan Pilih Kandidat</option>
                                            @foreach ($kandidats as $item)
                                                <option value="{{ $item->id }}">{{ $item->nomor }}. {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-danger mt-3">Admin tidak bisa vote</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </section>

    <!-- end food section -->

    <!-- footer section -->
    <footer class="footer_section">
        <div class="">
            <div class="row">
                <div class="col-md-4 footer-col">
                    <div class="footer_contact">
                        {{-- <h4>
                            Contact Us
                        </h4> --}}
                        <div class="contact_link_box d-flex justify-content-center align-items-center">
                            <img src="{{ asset('asset/logo-UNEJ.webp') }}" alt="Logo UNEJ" style="max-width: 150px; height: auto;">

                            {{-- <a href="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>
                                    Call +01 1234567890
                                </span>
                            </a> --}}
                            {{-- <a href="mailto:hme@unej.ac.id">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>
                                    hme@unej.ac.id
                                </span>
                            </a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 footer-col">
                    <div class="footer_detail">
                        <h3 href="" class=" roman">
                            <b>{{ config('app.name') }}</b>
                        </h3>
                        <p>Himpunan Mahasiswa Elektro | Fakultas Teknik | Universitas Jember</p>
                        <div class="footer_social">
                            <a target="_blank" href="https://hme.teknik.unej.ac.id/">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                            </a>
                            <a target="_blank" href="http://wa.me/6283851360583">
                                <i class="fa fa-whatsapp" aria-hidden="true"></i>
                            </a>
                            <a target="_blank" href="https://t.me/hmeuj_bot">
                                <i class="fa fa-telegram" aria-hidden="true"></i>
                            </a>
                            <a target="_blank" href="https://www.instagram.com/hme.unej">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                            <a target="_blank" href="https://twitter.com/HmeUnej">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a target="_blank" href="https://www.facebook.com/hme.unej.75">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            {{-- <a target="_blank" href="">
                                <i class="fa fa-pinterest" aria-hidden="true"></i>
                            </a> --}}
                        </div>
                        <a target="_blank" href="https://maps.app.goo.gl/b43Ki5RcCqNUTdQN7" class="text-white">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>
                                Fakultas Teknik Universitas Jember
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 footer-col d-flex justify-content-center align-items-center">
                    <img src="{{ asset('asset/logo-HME.png') }}" alt="Logo HME" style="max-height: 150px; width: auto;">
                </div>
            </div>
            <div class="footer-info">
                <p>
                    &copy; <span id="displayYear"></span> All Rights Reserved By
                    <a href="">{{ config('app.name') }}</a><br><br>
                    {{-- &copy; <span id="displayYear"></span> Distributed By
                    <a href="https://themewagon.com/" target="_blank">ThemeWagon</a> --}}
                </p>
            </div>
        </div>
    </footer>
    <!-- footer section -->

    @include('public.layouts.js')

    @if ($show == 1)
        <script>
            console.log('aaaaaaaaaaaaaaaaaaaaaaaaaaa');

            function getCounter() {
                // var countDownDate = new Date("Aug 11, 2021 22:00:00").getTime();
                var countDownDate = new Date("{{ Carbon\Carbon::parse($dates['start_date'])->format('M d, Y H:i:s') }}").getTime();

                console.log(countDownDate);
                var x = setInterval(function() {
                    var now = new Date().getTime();

                    var distance = countDownDate - now;

                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor(
                        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
                    );
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    var textDays = document.getElementById("days");
                    var textHours = document.getElementById("hours");
                    var textMinutes = document.getElementById("minutes");
                    var textSeconds = document.getElementById("seconds");

                    textDays.innerHTML = days < 10 ? "0" + days : days;
                    textHours.innerHTML = hours < 10 ? "0" + hours : hours;
                    textMinutes.innerHTML = minutes < 10 ? "0" + minutes : minutes;
                    textSeconds.innerHTML = seconds < 10 ? "0" + seconds : seconds;

                    if (distance < 0) {
                        clearInterval(x);
                        location.reload();
                    }

                    // console.log(distance);
                }, 1000);
            }

            getCounter()
        </script>
    @endif
</body>

</html>
