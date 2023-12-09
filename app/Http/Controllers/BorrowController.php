<?php

namespace App\Http\Controllers;

use App\Services\LoanService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    protected $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function borrow($id): RedirectResponse
    {
        $data['book_copy_id'] = $id;
        $data['user_id'] = Auth::user()->id;
        $data['loan_date'] = Carbon::now();
        $data['status'] = 0;

        $response = $this->loanService->store($data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => 'Gagal melakukan peminjaman buku']);
        }

        return redirect()->route('home')->with('success', 'Buku telah berhasil dipinjam! <br>Harap menunggu konfirmasi...');
    }
}
