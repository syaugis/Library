<?php

namespace App\Services;

use App\Models\BookCopy;
use App\Repositories\BookCopyRepository;
use App\Repositories\BookRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BookCopyService
{
    protected $bookCopyRepository;
    protected $bookRepository;

    public function __construct(BookCopyRepository $bookCopyRepository, BookRepository $bookRepository)
    {
        $this->bookCopyRepository = $bookCopyRepository;
        $this->bookRepository = $bookRepository;
    }

    public function getAll(): Collection
    {
        return $this->bookCopyRepository->getAll();
    }

    public function getById($id): BookCopy
    {
        return $this->bookCopyRepository->getById($id);
    }

    public function store($data, $id)
    {
        $validator = Validator::make($data, [
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator->errors()];
        }

        DB::beginTransaction();
        try {
            $book = $this->bookRepository->getById($id);
            $quantity = $data['quantity'];
            $this->bookCopyRepository->store($book, $quantity);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            return ['error' => 'Unable to add data'];
        }
        DB::commit();

        return $book;
    }

    public function update($data, $id)
    {
        $validator = Validator::make($data, [
            'is_available' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator->errors()];
        }

        DB::beginTransaction();
        try {
            $bookCopy = $this->bookCopyRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            return ['error' => 'Unable to update data'];
        }
        DB::commit();

        return $bookCopy;
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->bookCopyRepository->destroy($id);
            $status = 'success';
            $message = __('global-message.delete_form', ['form' => 'Book copy data']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            $status = 'errors';
            $message = $e->getMessage();
        }
        DB::commit();

        return ['status' => $status, 'message' => $message];
    }
}
