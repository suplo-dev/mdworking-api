<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{


    public function run(): void
    {
        $admin = User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        $user = User::query()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        $listUser = User::factory(100)->create();
        $roleAdmin = Role::create(['name' => RoleEnum::ADMIN->value]);
        $roleUser = Role::create(['name' => RoleEnum::USER->value]);
        foreach (PermissionEnum::all() as $permission){
            $permission = Permission::create(['name' => $permission]);
            $roleAdmin->givePermissionTo($permission);
            $admin->givePermissionTo($permission);
        }
//        foreach ([...PermissionEnum::manageAdsGG(),  ...PermissionEnum::manageAdsFB()] as $permission){
//            $roleUser->givePermissionTo($permission);
//            $listUser->each(fn($user) => $user->givePermissionTo($permission));
//        }

        $admin->assignRole($roleAdmin);

        $listUser->each(function($user) use ($roleUser) {
            $user->givePermissionTo(PermissionEnum::VIEW_ADS_FB->value, PermissionEnum::VIEW_ADS_GG->value);
            $user->assignRole($roleUser);
        });
        $user->givePermissionTo(PermissionEnum::VIEW_ADS_FB->value, PermissionEnum::VIEW_ADS_GG->value);
        $user->assignRole($roleUser);
    }
}
