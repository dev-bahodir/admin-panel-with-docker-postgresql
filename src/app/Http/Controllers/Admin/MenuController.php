<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Models\Role;
use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct(
        protected MenuService $menuService
    ) {}

    public function index()
    {
        return view('admin.menus.index', [
            'menus' => $this->menuService->list(),
        ]);
    }

    public function create()
    {

        return view('admin.menus.create', [
            'roles' => Role::where('name', '!=', 'super_admin')->get(),
        ]);
    }

    public function store(MenuRequest $request)
    {
        try {
            $menu = Menu::create($request->validated());
            $images = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $images[] = [
                        'path' => $image->store('menus/images', 'public'),
                        'is_primary' => false,
                    ];
                }

                $images[0]['is_primary'] = true;
            }

            $menu->update([
                'images' => $images,
            ]);


            return redirect()->route('admin.menus.index');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', [
            'menu'  => $menu,
            'roles' => Role::where('name', '!=', 'super_admin')->get(),
        ]);
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        try {
            $menu->update($request->validated());

            $images = $menu->images ?? [];

            if ($request->hasFile('images')) {
                $images = [];

                foreach ($request->file('images') as $image) {
                    $images[] = [
                        'path' => $image->store('menus/images', 'public'),
                        'is_primary' => false,
                    ];
                }
            }

            if ($request->filled('primary_image') && isset($images[$request->primary_image])) {
                foreach ($images as $i => $img) {
                    $images[$i]['is_primary'] = ($i == $request->primary_image);
                }
            }

            $menu->update([
                'images' => $images,
            ]);

            return redirect()->route('admin.menus.index');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Menu $menu)
    {
        try {
            $this->menuService->delete($menu);
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
