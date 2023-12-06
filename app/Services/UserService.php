<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function getById($id): User
    {
        return $this->userRepository->getById($id);
    }

    public function store($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'gender' => 'required|string|in:M,F',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|phone',
            'profile_image' => 'image|mimes:jpeg,png,jpg|max:4096',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator->errors()];
        }

        DB::beginTransaction();
        try {
            $author = $this->userRepository->store($data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to create data');
        }
        DB::commit();

        return $author;
    }

    public function update($data, $id)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $id,
            'gender' => 'required|string|in:M,F',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|phone',
            'profile_image' => 'image|mimes:jpeg,png,jpg|max:4096',
            'password' => 'nullable|min:8',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator->errors()];
        }

        DB::beginTransaction();
        try {
            $author = $this->userRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update data');
        }
        DB::commit();

        return $author;
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->userRepository->destroy($id);
            $status = 'success';
            $message = __('global-message.delete_form', ['form' => 'User data']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            $status = 'errors';
            $message = $e->getMessage();
        }
        DB::commit();

        return ['status' => $status, 'message' => $message];
    }
}
