<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\BookCopy;
use App\Models\Category;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin(Request $request)
    {
        $assets = ['chart', 'animation'];
        $data['total_books'] = BookCopy::count();
        $data['total_categories'] = Category::count();
        $data['total_authors'] = Author::count();
        $data['total_loans'] = Loan::count();
        $data['total_user'] = User::where('role', 1)->count();
        $data['new_members'] = User::where('role', 1)->whereDate('created_at', Carbon::today())->count();

        return view('admin.dashboard', compact('assets', 'data'));
    }
}
