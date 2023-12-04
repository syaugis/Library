<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\BookCopy;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class Select2Controller extends Controller
{
    public function getAuthors(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $authors = Author::orderby('name', 'asc')->select('id', 'name')->limit(5)->get();
        } else {
            $authors = Author::orderby('name', 'asc')->select('id', 'name')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = [];
        foreach ($authors as $author) {
            $response[] = [
                "id" => $author->id,
                "text" => $author->name
            ];
        }

        return response()->json($response);
    }

    public function getCategories(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $categories = Category::orderby('name', 'asc')->select('id', 'name')->limit(5)->get();
        } else {
            $categories = Category::orderby('name', 'asc')->select('id', 'name')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = [];
        foreach ($categories as $category) {
            $response[] = [
                "id" => $category->id,
                "text" => $category->name
            ];
        }

        return response()->json($response);
    }

    public function getBooks(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $bookCopies = BookCopy::orderby('id', 'asc')->select('id', 'book_id')
                ->where('is_available', '1')
                ->with(['book' => function ($query) {
                    $query->select('id', 'title');
                }])
                ->limit(5)->get();
        } else {
            $bookCopies = BookCopy::orderby('id', 'asc')->select('id', 'book_id')
                ->where('is_available', '1')
                ->with(['book' => function ($query) {
                    $query->select('id', 'title');
                }])
                ->whereHas('book', function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                })
                ->limit(5)->get();
        }

        $response = [];
        foreach ($bookCopies as $bookCopy) {
            $response[] = [
                "id" => $bookCopy->id,
                "text" => $bookCopy->book->title . ' - (' . $bookCopy->id . ')',
            ];
        }

        return response()->json($response);
    }

    public function getUsers(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $users = User::orderby('name', 'asc')->select('id', 'name')
                ->where('role', '1')
                ->limit(5)->get();
        } else {
            $users = User::orderby('name', 'asc')->select('id', 'name')
                ->where('role', '1')
                ->where('name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = [];
        foreach ($users as $user) {
            $response[] = [
                "id" => $user->id,
                "text" => $user->name
            ];
        }

        return response()->json($response);
    }
}
