<?php

namespace App\Repositories;

use App\Models\BookCopy;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Collection;

class LoanRepository
{
    protected $loan;

    public function __construct(Loan $loan)
    {
        $this->loan = $loan;
    }

    public function getAll(): Collection
    {
        return $this->loan->get();
    }

    public function getById($id)
    {
        return $this->loan->with('user', 'bookCopy')->where('id', $id)->first();
    }

    public function store($data): Loan
    {
        $loan = new $this->loan;
        $loan->book_copy_id = $data['book_copy_id'];
        $loan->user_id = $data['user_id'];
        $loan->loan_date = $data['loan_date'];
        if (!empty($data['return_date'])) {
            $loan->return_date = $data['return_date'];
        }
        $loan->status = $data['status'];
        $loan->save();

        if ($data['status'] === '1') {
            $bookCopy = BookCopy::find($data['book_copy_id']);
            $bookCopy->is_available = false;
            $bookCopy->save();
        }

        return $loan;
    }

    public function update($data, $id)
    {
        $loan = $this->loan->find($id);
        $loan->book_copy_id = $data['book_copy_id'];
        $loan->user_id = $data['user_id'];
        $loan->loan_date = $data['loan_date'];
        if (!empty($data['return_date'])) {
            $loan->return_date = $data['return_date'];
        }
        $loan->status = $data['status'];

        $bookCopy = BookCopy::find($data['book_copy_id']);
        if ($data['status'] === '1' || $data['status'] === '2') {
            $bookCopy->is_available = false;
        } elseif ($data['status'] === '4') {
            if ($loan->return_date == null) {
                return ['error' => 'Book return date must be filled'];
            } else {
                $bookCopy->is_available = true;
            }
        } else {
            $bookCopy->is_available = true;
        }

        $bookCopy->save();
        $loan->update();

        return $loan;
    }

    public function destroy($id): Loan
    {
        $loan = $this->loan->find($id);
        $bookCopyId = $loan->book_copy_id;
        $loan->delete();

        if ($bookCopyId) {
            $bookCopy = BookCopy::find($bookCopyId);
            if ($bookCopy) {
                $bookCopy->is_available = true;
                $bookCopy->save();
            }
        }

        return $loan;
    }
}
