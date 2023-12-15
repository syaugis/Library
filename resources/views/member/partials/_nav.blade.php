    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <div class="d-flex align-items-center me-3">
                <img alt="logo" class="img-fluid" style="max-width: 150px; max-height: 50px;"
                    src="{{ asset('images/icons/surabaya.png') }}">
            </div>
            <div class="d-flex flex-column ml-2">
                <h3 class="m-0">Perpustakaan</h3>
                <h4 class="lead m-0">Wonorejo RW 8</h4>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if (!empty(Auth::user()->profile_image))
                                <img src="{{ url('uploads/img_profiles/' . Auth::user()->profile_image) }}"
                                    class="rounded-circle shadow-4-strong me-2" height="30" width="25" alt="Avatar"
                                    loading="lazy" />
                            @else
                                <i class="fa fa-user px-1 py-2" aria-hidden="true"></i>
                            @endif
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ route('member.profile') }}">
                                {{ __('Profil Pengguna') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('member.history') }}">
                                {{ __('Riwayat Peminjaman') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Keluar') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
