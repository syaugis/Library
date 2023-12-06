<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll(): Collection
    {
        return $this->user->get();
    }

    public function getById($id)
    {
        return $this->user->where('id', $id)->first();
    }

    public function store($data): User
    {
        $user = new $this->user;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->gender = $data['gender'];
        $user->birth_date = $data['birth_date'];
        $user->address = $data['address'];
        $user->phone_number = $data['phone_number'];
        if (!empty($data['profile_image'])) {
            $imageName = $data['profile_image']->hashName();
            $data['profile_image']->move(public_path('uploads/img_profiles'), $imageName);
            $user->profile_image = $imageName;
        }
        $user->password = Hash::make($data['password']);
        $user->save();

        return $user;
    }

    public function update($data, $id): User
    {
        $user = $this->user->find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->gender = $data['gender'];
        $user->birth_date = $data['birth_date'];
        $user->address = $data['address'];
        $user->phone_number = $data['phone_number'];
        if (!empty($data['profile_image'])) {
            $imageName = $user->getAttribute('profile_image');
            if (!empty($imageName) && file_exists("uploads/img_profiles/" . $imageName)) {
                unlink('uploads/img_profiles/' . $imageName);
            }
            $imageName = $data['profile_image']->hashName();
            $data['profile_image']->move(public_path('uploads/img_profiles'), $imageName);
            $user->profile_image = $imageName;
        }
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->update();

        return $user;
    }

    public function destroy($id): User
    {
        $user = $this->user->find($id);
        $imageName = $user->getAttribute('profile_image');
        if (!empty($imageName) && file_exists("uploads/img_profiles/" . $imageName)) {
            unlink('uploads/img_profiles/' . $imageName);
        }
        $user->delete();

        return $user;
    }
}
