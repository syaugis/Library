<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\DataTables\UserDataTableService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $userService;
    protected $userDataTableService;

    public function __construct(UserService $userService, UserDataTableService $userDataTableService)
    {
        $this->userService = $userService;
        $this->userDataTableService = $userDataTableService;
    }

    public function index()
    {
        try {
            $assets = ['data-table'];
            $pageTitle = 'Book User Data';
            $headerAction = '<a href="' . route('admin.user.create') . '" class="btn btn-sm btn-primary" role="button">Add User</a>';
            return $this->userDataTableService->render('admin.user.index', compact('assets', 'pageTitle', 'headerAction'));
        } catch (Exception $e) {
            $error = $e->getMessage();
            return back()->withErrors($error);
        }
    }

    public function create(): View
    {
        return view('admin.user.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->only([
            'name',
            'email',
            'gender',
            'birth_date',
            'address',
            'phone_number',
            'profile_image',
            'password',
        ]);

        if (empty($data['password'])) {
            $password = str_replace('-', '', $data['birth_date']);
            $data['password'] = $password;
        }

        $response = $this->userService->store($data);

        if (isset($response['error'])) {
            return back()->withErrors($response['error'])->withInput();
        }

        return redirect()->route('admin.user.index')->withSuccess(__('global-message.save_form', ['form' => 'User data']));
    }

    public function edit($id): View
    {
        $data = $this->userService->getById($id);
        return view('admin.user.form', compact('data', 'id'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->only([
            'name',
            'email',
            'gender',
            'birth_date',
            'address',
            'phone_number',
            'profile_image',
            'password',
        ]);

        $response = $this->userService->update($data, $id);

        if (isset($response['error'])) {
            return back()->withErrors($response['error'])->withInput();
        }

        return redirect()->route('admin.user.index')->withSuccess(__('global-message.update_form', ['form' => 'User data']));
    }

    public function destroy($id): RedirectResponse
    {
        $result = $this->userService->destroy($id);
        $status = $result['status'];
        $message = $result['message'];

        if (request()->ajax()) {
            return response()->json(['status' => true, 'message' => $message, 'datatable_reload' => 'dataTable_wrapper']);
        }

        return redirect()->back()->with($status, $message);
    }
}
