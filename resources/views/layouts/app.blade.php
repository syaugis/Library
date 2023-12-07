<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Wonorejo RW 8 | Perpustakaan</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CSS  -->
    <link rel="stylesheet" href="{{ asset('/css/home.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
        integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <header class="header">
            <div class="mask">
                <nav class="navbar navbar-expand-md navbar-dark bg-transparent shadow-sm">
                    <div class="container">
                        <a class="navbar-brand inline-flex items-center" href="{{ url('/') }}">
                            {{-- <img class="h-8 w-8" src="logo"> --}}
                            <div class="inline-flex flex-col leading-tight ml-2">
                                <h3 class="text-lg m-0 p-0">Perpustakaan</h3>
                                <h4 class="text-sm lead m-0 p-0"> Wonorejo RW 8</h4>
                            </div>
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ms-auto">
                                <!-- Authentication Links -->
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Masuk') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Keluar') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="search-home mb-4">
                    <div style="margin-left: 10px; padding-left: 10px; padding-right: 10px; margin-right: 10px;">
                        <div>
                            <div class="row">
                                <div class="col-lg-8 mx-auto">
                                    <div
                                        style="margin-bottom: 2em; margin-top: 1em; width: 1234px; margin-left: auto !important; margin-right: auto !important; display: block; max-width: 100% !important; box-sizing: inherit; color: rgb(255, 255, 255);">
                                        <div>
                                            <h1>RW 8 Wonorejo Library Catalogue</h1>
                                            <div>Books, magazines, comics at RW 8 Wonorejo Library.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 mx-auto">
                                    <div class="card border-0 shadow" style="background-color: rgb(255, 255, 255);">
                                        <div class="card-body" style="padding: 0.55rem;">
                                            <form action="{{ route('search') }}" method="get">
                                                {{-- <input type="hidden" name="search" value="search"> --}}
                                                <input value="{{ request('keywords') }}" type="text"
                                                    id="search-input" name="keywords" autocomplete="off"
                                                    placeholder="Masukkan judul buku untuk mencari koleksi..."
                                                    class="input-transparent w-100">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </header>
    </div>
    <main>
        <div class="content">
            @yield('content')
        </div>
    </main>
    </div>
    <footer class="bg-dark text-light text-center">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-1 mb-md-0">
                    <p>
                        Perpustakaan Wonorejo RW 8 Surabaya
                    </p>
                </div>

                <div class="col-lg-6 col-md-12 mb-1 mb-md-0">
                    <p>
                        ©{{ Carbon\Carbon::now()->year }} — Maded By
                        <a class="text-light" href="https://github.com/syaugis/" target="_blank">syaugi_s</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
    integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $(".search").select2({
            ajax: {
                url: "{{ route('admin.get.books') }}",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });
</script>

</html>
