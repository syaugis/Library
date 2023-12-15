<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): View
    {
        $id = Auth::user()->id;
        $data = User::where('id', $id)->first();
        return view('member.profile.index', compact('data', 'id'));
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

        return redirect()->route('home')->with('success', 'Data profil pengguna telah berhasil diperbaharui!');
    }
}
