<?php

namespace App\Http\Controllers;

use App\Services\BookCopyService;
use App\Services\DataTables\BookCopyDataTableService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookCopyController extends Controller
{
    protected $bookCopyService;
    protected $bookCopyDataTableService;

    public function __construct(BookCopyService $bookCopyService, BookCopyDataTableService $bookCopyDataTableService)
    {
        $this->bookCopyService = $bookCopyService;
        $this->bookCopyDataTableService = $bookCopyDataTableService;
    }

    public function index()
    {
        try {
            $assets = ['data-table'];
            $pageTitle = 'Book List Data';
            return $this->bookCopyDataTableService->render('admin.book_copy.index', compact('assets', 'pageTitle'));
        } catch (Exception $e) {
            $error = $e->getMessage();
            return back()->withErrors($error);
        }
    }

    public function create($id): View
    {
        return view('admin.book_copy.add', compact('id'));
    }

    public function store(Request $request, $id): RedirectResponse
    {
        $data = $request->only([
            'quantity',
        ]);

        $response = $this->bookCopyService->store($data, $id);

        if (isset($response['error'])) {
            return back()->withErrors($response['error'])->withInput();
        }

        return redirect()->back()->withSuccess(__('global-message.save_form', ['form' => 'Book copy data']));
    }

    public function edit($id): View
    {
        $data = $this->bookCopyService->getById($id);
        return view('admin.book_copy.edit', compact('data', 'id'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->only([
            'is_available',
        ]);

        $response = $this->bookCopyService->update($data, $id);

        if (isset($response['error'])) {
            return back()->withErrors($response['error'])->withInput();
        }

        return redirect()->back()->withSuccess(__('global-message.update_form', ['form' => 'Book copy data']));
    }

    public function destroy($id): RedirectResponse
    {
        $result = $this->bookCopyService->destroy($id);
        $status = $result['status'];
        $message = $result['message'];

        if (request()->ajax()) {
            return response()->json(['status' => true, 'message' => $message, 'datatable_reload' => 'dataTable_wrapper']);
        }

        return redirect()->back()->with($status, $message);
    }
}
