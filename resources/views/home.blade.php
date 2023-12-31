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
                                        <div class="overlay-container">
                                            <img src="{{ asset($book->cover_image ? 'uploads/img_books/' . $book->cover_image : 'images/error/no_cover.png') }}"
                                                class="img-fluid rounded w-100" alt="cover">
                                            <div class="overlay"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-xl-6">
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
                                            <dt class="col-sm-6">Penerbit</dt>
                                            <dd class="col-sm-6">{{ $book->publisher }}</dd>
                                            <dt class="col-sm-6">Tahun Terbit</dt>
                                            <dd class="col-sm-6">{{ $book->published_year }}</dd>
                                            <dt class="col-sm-6">ISBN</dt>
                                            <dd class="col-sm-6">{{ $book->isbn ? $book->isbn : 'Tidak Ada' }}</dd>
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
                                            <a class="btn btn-primary btn-sm w-100"
                                                href="{{ route('detail.book', $book->id) }}" type="button">Detail Buku</a>
                                            <form
                                                action="{{ route('member.borrow', empty($book->copies->where('is_available', true)->first()->id) ? 'null' : $book->copies->where('is_available', true)->first()->id) }}"
                                                method="post" id="borrow-form-{{ $book->id }}">
                                                @csrf

                                                @if (!empty($book->copies->where('is_available', true)->first()->id))
                                                    <button class="btn btn-outline-primary btn-sm w-100 mt-2"
                                                        onclick="showConfirmation({{ $book->id }})" type="button">
                                                        Tambahkan ke peminjaman
                                                    </button>
                                                @else
                                                    <button class="btn btn-outline-secondary btn-sm w-100 mt-2 disabled"
                                                        type="button">
                                                        Tidak Tersedia
                                                    </button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-center">
                        {!! $books->links() !!}
                    </div>
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
