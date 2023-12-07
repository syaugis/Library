<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookCopy;
use App\Models\Category;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = $request->input('keywords');

        if ($query) {
            $books = Book::where('title', 'like', '%' . $query . '%')
                // ->orWhere('author', 'like', '%' . $query . '%')
                ->paginate(5);
        } else {
            $books = Book::paginate(5);
        }

        return view('home', compact('books'));
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
