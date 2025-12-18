<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Menu;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(
        protected RoleService $roleService
    )
    {
    }

    public function index()
    {
        $roles = $this->roleService->list();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('admin.roles.create', compact('menus'));
    }

    public function store(RoleRequest $request)
    {
        try {
            $role = Role::create($request->validated());

            if ($request->has('menus')) {
                $role->menus()->sync($request->menus);
            }

            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Role $role)
    {

        return view('admin.roles.edit', [
            'role' => $role,
            'menus' => Menu::orderBy('order')->get(),
            'role_menu' => $role->menus()->pluck('menus.id')->toArray(),
        ]);
    }

    public function update(RoleRequest $request, Role $role)
    {
        try {
            $role->update($request->validated());

            $role->menus()->sync($request->menus ?? []);

            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Role $role)
    {
        try {
            $this->roleService->delete($role);
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
