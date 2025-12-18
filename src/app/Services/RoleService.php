<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    public function list()
    {
        return Role::where('name', '!=', 'super_admin')->get();
    }

    public function create(string $name)
    {
        return Role::create(['name' => $name]);
    }

    public function update(Role $role, string $name)
    {
        $role->update(['name' => $name]);
    }

    public function delete(Role $role)
    {
        $role->delete();
    }
}
