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

    public function borrow(Request $request, $id): RedirectResponse
    {
        // $data = $request->only([
        //     'id',
        // ]);

        $data['book_copy_id'] = $id;
        $data['user_id'] = Auth::user()->id;
        $data['loan_date'] = Carbon::now();
        $data['status'] = 0;

        $response = $this->loanService->store($data);

        if (isset($response['error'])) {
            return back()->withErrors($response['error'])->withInput();
        }

        return redirect()->route('home');
    }
}
