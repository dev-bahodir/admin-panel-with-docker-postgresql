<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct(
        protected UserService $userService
    ) {}

    public function index()
    {
        $users = $this->userService->list(auth()->user());

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create', [
            'roles' => $this->userService->assignableRoles(),
        ]);
    }

    public function store(UserRequest $request)
    {
        try {
            $this->userService->create($request->validated());
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user'  => $user,
            'roles' => $this->userService->assignableRoles(),
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            $this->userService->update($user, $request->validated());
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        try {
            $this->userService->delete($user);
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
