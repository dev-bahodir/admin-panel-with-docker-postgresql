<?php

namespace App\Services;


use App\Models\Menu;
use App\Models\User;


class MenuService
{
    public function list()
    {
        return Menu::with('roles')->orderBy('order')->get();
    }

    public function create(array $data)
    {
        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        $menu = Menu::create($data);
        $menu->roles()->sync($roles);

        return $menu;
    }

    public function update(Menu $menu, array $data)
    {
        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        $menu->update($data);
        $menu->roles()->sync($roles);
    }

    public function delete(Menu $menu)
    {
        $menu->delete();
    }

    public function forUser(?User $user)
    {
        if (!$user) {
            return collect();
        }

        return Menu::whereHas('roles', function ($q) use ($user) {
            $q->where('roles.id', $user->role_id);
        })
            ->orderBy('order')
            ->get();
    }

    public function getForUser(?User $user)
    {

        if ($user->role_id == 1) {
            return Menu::orderBy('order')->get();
        }

        return Menu::whereHas('roles', function ($q) use ($user) {
            $q->where('roles.id', $user->role_id);
        })
            ->orderBy('order')
            ->get();
    }

}
