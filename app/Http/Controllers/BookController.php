<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use App\Services\DataTables\BookCopyDataTableService;
use App\Services\DataTables\BookDataTableService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    protected $bookService;
    protected $bookDataTableService;
    protected $bookCopyDataTableService;

    public function __construct(BookService $bookService, BookDataTableService $bookDataTableService, BookCopyDataTableService $bookCopyDataTableService)
    {
        $this->bookService = $bookService;
        $this->bookDataTableService = $bookDataTableService;
        $this->bookCopyDataTableService = $bookCopyDataTableService;
    }

    public function index()
    {
        try {
            $assets = ['data-table'];
            $pageTitle = 'Book Data';
            $headerAction = '<a href="' . route('admin.book.create') . '" class="btn btn-sm btn-primary" role="button">Add Book</a>';
            return $this->bookDataTableService->render('admin.book.index', compact('assets', 'pageTitle', 'headerAction'));
        } catch (Exception $e) {
            $error = $e->getMessage();
            return back()->withErrors($error);
        }
    }

    public function create(): View
    {
        $assets = ['select2'];
        return view('admin.book.form', compact('assets'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->only([
            'title',
            'authors',
            'publisher',
            'published_year',
            'categories',
            'isbn',
            'language',
            'pages',
            'cover_image',
        ]);

        $response = $this->bookService->store($data);

        if (isset($response['error'])) {
            return back()->withErrors($response['error'])->withInput();
        }

        return redirect()->route('admin.book.index')->withSuccess(__('global-message.save_form', ['form' => 'Book data']));
    }

    public function edit($id)
    {
        $assets = ['select2', 'data-table'];
        $pageTitle = 'Book List Data';
        $headerAction = '<a class="btn btn-sm btn-primary" data-toggle="modal" id="formAdd" 
            data-target="#formModal"data-attr="' . route('admin.book_copy.create', $id) . '"
            role="button">Add Book Copies</a>';
        $data = $this->bookService->getById($id);

        return $this->bookCopyDataTableService->withBookId($id)->render('admin.book.form', compact('assets', 'pageTitle', 'headerAction', 'data', 'id'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->only([
            'title',
            'authors',
            'publisher',
            'published_year',
            'categories',
            'isbn',
            'language',
            'pages',
            'cover_image',
        ]);

        $response = $this->bookService->update($data, $id);

        if (isset($response['error'])) {
            return back()->withErrors($response['error'])->withInput();
        }

        return redirect()->route('admin.book.index')->withSuccess(__('global-message.update_form', ['form' => 'Book data']));
    }

    public function destroy($id): RedirectResponse
    {
        $result = $this->bookService->destroy($id);
        $status = $result['status'];
        $message = $result['message'];

        if (request()->ajax()) {
            return response()->json(['status' => true, 'message' => $message, 'datatable_reload' => 'dataTable_wrapper']);
        }

        return redirect()->back()->with($status, $message);
    }
}
