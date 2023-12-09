<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function index(): View
    {
        $loans = Loan::where('user_id', Auth::user()->id)->get();
        return view('member.history.index', compact('loans'));
    }
}
