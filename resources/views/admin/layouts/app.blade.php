<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="author" content="hme, unej">
    <meta name="description" content="">
    <meta name="keywords" content="hme, unej, hme unej, elektro, himpunan mahasiswa, himpunan elekteo, himpunan mahasiswa elektro">
    <link rel="icon" type="image/x-icon" href="{{ asset('asset/logo-HME.png') }}">

    <title>@yield('title') - {{ config('app.name') }}</title>
    @include('admin.layouts.css')
    <!-- Page Specific -->
    @stack('css')
    {{-- <link href="https://cdn.jsdelivr.net/gh/eliyantosarage/font-awesome-pro@main/fontawesome-pro-6.5.1-web/css/all.min.css" rel="stylesheet"> --}}
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            @include('admin.layouts.navbar')
            @include('admin.layouts.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    @yield('content')
                </section>
            </div>
            @include('admin.layouts.footer')

            @stack('modal')
        </div>
    </div>
    @include('admin.layouts.js')
    <!-- Sweetalert -->
    @include('sweetalert::alert')
    <!-- Page Specific -->
    @stack('js')
</body>

</html>
