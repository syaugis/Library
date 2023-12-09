<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('member.partials._head')
    <!-- CSS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
        integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="app">
        <header class="header">
            <div class="mask">
                <nav class="navbar navbar-expand-md navbar-dark bg-transparent shadow-sm">
                    @include('member.partials._nav')
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
                                                    placeholder="Masukkan judul buku, nama pengarang atau kategori untuk mencari koleksi..."
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
        <div class="content py-4">
            @yield('content')
        </div>
    </main>
    </div>
    @include('member.partials._footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.1/sweetalert2.all.min.js"
        integrity="sha512-1SVc8wK7Y/XRAKRKfP09ILQmzJGwqq6m66x6mWa7r36j+/fa+3kz46s8kvELsGc52yo1as48nneFic7BZKMu8Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function showConfirmation(bookId) {
            event.preventDefault();
            Swal.fire({
                title: 'Pinjam Buku!',
                text: 'Apakah Anda yakin untuk meminjam buku ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, pinjam!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('borrow-form-' + bookId).submit();
                }
            });
        }
        @if (session('success'))
            Swal.fire({
                title: 'Sukses!',
                html: '{!! session('success') !!}',
                icon: 'success',
                showConfirmButton: true,
            });
        @elseif ($errors->any())
            Swal.fire({
                title: 'Oops...',
                html: '@foreach ($errors->all() as $error){{ $error }}<br>@endforeach',
                icon: 'error',
                showConfirmButton: true,
            });
        @endif
    </script>
</body>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
    integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
{{-- <script type="text/javascript">
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
</script> --}}

</html>
