<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\BookCopy;
use Illuminate\Database\Eloquent\Collection;

class BookCopyRepository
{
    protected $bookCopy;

    public function __construct(BookCopy $bookCopy)
    {
        $this->bookCopy = $bookCopy;
    }

    public function getAll(): Collection
    {
        return $this->bookCopy->get();
    }

    public function getById($id): BookCopy
    {
        return $this->bookCopy->where('id', $id)->first();
    }

    public function store(Book $book, int $quantity): void
    {
        for ($i = 0; $i < $quantity; $i++) {
            $bookCopy = new $this->bookCopy;
            $bookCopy->book()->associate($book);
            $bookCopy->save();
        }
    }

    public function update($data, $id): BookCopy
    {
        $bookCopy = $this->bookCopy->find($id);
        $bookCopy->is_available = $data['is_available'];
        $bookCopy->update();

        return $bookCopy;
    }

    public function destroy($id): BookCopy
    {
        $bookCopy = $this->bookCopy->find($id);
        $bookCopy->delete();

        return $bookCopy;
    }
}
