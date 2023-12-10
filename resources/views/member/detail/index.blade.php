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
                            @if (!empty($book))
                                <div class="card elevation shadow-0 border rounded mb-5">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                                <div class="overlay-container">
                                                    <img src="{{ asset($book->cover_image ? 'uploads/img_books/' . $book->cover_image : 'images/error/no_cover.png') }}"
                                                        class="img-fluid rounded w-100" alt="cover">
                                                    <div class="overlay"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-8 col-lg-8 col-xl-8">
                                                <h3 style="font-weight: 600">{{ $book->title }}</h3>
                                                <div class="d-flex relations flex-wrap">
                                                    @foreach ($book->authors as $author)
                                                        <a href="{{ route('search') . '?keywords=' . str_replace(' ', '+', $author->name) }}"
                                                            class="btn btn-outline-primary btn-rounded">
                                                            {{ $author->name }} </a>
                                                    @endforeach
                                                </div>

                                                <div class="d-flex relations flex-wrap mb-2">
                                                    @foreach ($book->categories as $category)
                                                        <a href="{{ route('search') . '?keywords=' . str_replace(' ', '+', $category->name) }}"
                                                            class="btn btn-outline-secondary btn-rounded">
                                                            {{ $category->name }} </a>
                                                    @endforeach
                                                </div>

                                                <div class="row">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">ID Buku</th>
                                                                <th scope="col">Status Ketersediaan Buku</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($book->copies as $copy)
                                                                <tr scope="row">
                                                                    <th scope="row"> {{ $copy->id }} </th>
                                                                    <td> {{ App\Helpers\LoanHelpers::getStatus($copy->is_available) }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <dt class="col-sm-4">Penerbit</dt>
                                                    <dd class="col-sm-6">{{ $book->publisher }}</dd>
                                                    <dt class="col-sm-4">Tahun Terbit</dt>
                                                    <dd class="col-sm-6">{{ $book->published_year }}</dd>
                                                    <dt class="col-sm-4">ISBN</dt>
                                                    <dd class="col-sm-6">{{ $book->isbn ? $book->isbn : 'Tidak Ada' }}
                                                    </dd>
                                                    <dt class="col-sm-4">Bahasa</dt>
                                                    <dd class="col-sm-6">{{ $book->language }}</dd>
                                                    <dt class="col-sm-4">Jumlah Halaman</dt>
                                                    <dd class="col-sm-6">{{ $book->pages }}</dd>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                            @if (empty($book))
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="text-center">Tidak ada data detail buku</h4>
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
