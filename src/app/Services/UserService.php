<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function list(User $authUser)
    {
        return User::with('role')
            ->whereHas('role', fn ($q) => $q->where('name', '!=', 'super_admin'))
            ->get()
            ->map(function (User $user) use ($authUser) {
                return [
                    'id'        => $user->id,
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'role_name' => $user->role?->name,
                    'destroy'   => $this->canDelete($authUser, $user),
                ];
            });
    }

    public function create(array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return User::create($data);
    }

    public function update(User $user, array $data)
    {
        if ($user->role->name === 'super_admin') {
            abort(403, 'Super admin cannot be edited');
        }

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
    }

    public function delete(User $user)
    {
        if ($user->role->name === 'super_admin') {
            abort(403, 'Super admin cannot be deleted');
        }

        $user->delete();
    }

    public function assignableRoles()
    {
        return Role::where('name', '!=', 'super_admin')->get();
    }

    private function canDelete(User $authUser, User $targetUser): bool
    {
        if ($targetUser->role->name === 'super_admin') {
            return false;
        }

        if ($authUser->id === $targetUser->id) {
            return false;
        }

        return $authUser->role->name === 'super_admin';
    }

}
