@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="d-flex justify-content-center">
                {!! $books->links() !!}
            </div>
            <div class="col-md-8">
                @if ($books->count() > 0)
                    @foreach ($books as $book)
                        <div class="card elevation shadow-0 border rounded mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                        <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                            <img src="{{ asset($book->cover_image ? 'uploads/img_books/' . $book->cover_image : 'images/error/no_cover.png') }}"
                                                alt="cover" class="img-fluid rounded w-100">
                                            <a href="#!">
                                                <div class="hover-overlay">
                                                    <div class="mask"
                                                        style="background-color: rgba(253, 253, 253, 0.15);">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <h4>{{ $book->title }}</h4>
                                        <div class="d-flex flex-row">
                                            <div class="text-danger mb-1 me-2">
                                                @foreach ($book->authors as $author)
                                                    <i>{{ $author->name }}</i>;
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row">
                                            <div class="text-danger mb-1 me-2">
                                                @foreach ($book->categories as $category)
                                                    <i>{{ $category->name }}</i>;
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row">
                                            <dt class="col-sm-6">Penerbit</dt>
                                            <dd class="col-sm-6">{{ $book->publisher }}</dd>
                                            <dt class="col-sm-6">Tahun Terbit</dt>
                                            <dd class="col-sm-6">{{ $book->published_year }}</dd>
                                            <dt class="col-sm-6">ISBN</dt>
                                            <dd class="col-sm-6">{{ $book->isbn }}</dd>
                                            <dt class="col-sm-6">Bahasa</dt>
                                            <dd class="col-sm-6">{{ $book->language }}</dd>
                                            <dt class="col-sm-6">Jumlah Halaman</dt>
                                            <dd class="col-sm-6">{{ $book->pages }}</dd>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                        <div class="card">
                                            <div class="card-body pt-3 pb-2 px-1">
                                                <div class="d-flex align-items-center justify-content-center flex-column">
                                                    <span class="mb-2">Ketersediaan</span>
                                                    <h4> {!! $book->copies->where('is_available', true)->count() != 0
                                                        ? $book->copies->where('is_available', true)->count()
                                                        : '  <span class="text-danger">Tidak Ada</span>' !!}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mt-4">
                                            <button class="btn btn-primary btn-sm" type="button">Detail Buku</button>
                                            <form
                                                action="{{ route('member.borrow', empty($book->copies->where('is_available', true)->first()->id) ? 'null' : $book->copies->where('is_available', true)->first()->id) }}"
                                                method="post">
                                                @csrf
                                                <button class="btn btn-outline-primary btn-sm mt-2" type="submit">
                                                    Tambahkan ke peminjaman
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card elevation shadow-0 border rounded mt-5 mb-5">
                        <div class="card-body text-center mt-3 mb-2">
                            <h5>Tidak ada Hasil yang ditemukan</h5>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
