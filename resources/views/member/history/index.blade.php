<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('member.partials._head')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            @include('member.partials._nav')
        </nav>
    </div>
    <main>
        <div class="content">
            <div class="container" style="margin-bottom:18rem;">
                <div class="row justify-content-center">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('home') }}" class="btn btn-outline-primary mb-4 mt-4"><i
                                    class="fa fa-arrow-left"></i>
                                Kembali</a>
                        </div>

                        <div class="col-md-12 mb-5">
                            @if (!empty($loans))
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <div class="col-md-12 d-flex justify-content-center mb-3">
                                            <h4 class="pt-2">
                                                <i class="fa fa-history me-2 ms-2"></i>
                                                Riwayat Peminjaman Buku
                                            </h4>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Index</th>
                                                            <th scope="col">Judul Buku</th>
                                                            <th scope="col">Tanggal Peminjaman</th>
                                                            <th scope="col">Tanggal Pengembalian</th>
                                                            <th scope="col">Status Pinjaman</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($loans as $loan)
                                                            <tr scope="row">
                                                                <th scope="row"> {{ $loop->iteration }} </th>
                                                                <td> {{ $loan->bookCopy->book->title }} </td>
                                                                <td>
                                                                    {{ $loan->loan_date }}
                                                                </td>
                                                                <td> {{ $loan->return_date }} </td>
                                                                <td> {{ App\Helpers\LoanHelpers::getStatus($loan->status) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (empty($loans))
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="text-center">Tidak ada riwayat peminjaman buku</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('member.partials._footer')
</body>

</html>
