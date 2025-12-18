<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name', 'super_admin')->first();

        Menu::all()->each(function ($menu) use ($role) {
            $menu->roles()->syncWithoutDetaching([$role->id]);
        });
    }
}
