<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $permissions = Permission::select('name')->get();
        foreach ($permissions as $permission) {
            $rolePermissions[] = $permission->name;
        }

        $superadmin = [
            'voting view',
            'dashboard view',
            'mahasiswa create',
            'mahasiswa view',
            'mahasiswa edit',
            'mahasiswa delete',
            'admin create',
            'admin view',
            'admin edit',
            'admin delete',
            'kandidat create',
            'kandidat view',
            'kandidat edit',
            'kandidat delete',
        ];
        $admin = [
            'voting view',
            'dashboard view',
            'mahasiswa create',
            'mahasiswa view',
            'mahasiswa edit',
            'mahasiswa delete',
            'admin view',
            'kandidat view',
        ];
        $umum = [
            'voting view',
            'voting vote',
        ];


        $role = [
            '1' => [
                'Superadmin', $superadmin
            ],
            '2' => [
                'Admin', $admin,
            ],
            '3' => [
                'Umum', $umum,
            ],
        ];

        foreach ($role as $key => $value) {
            $role = Role::updateOrCreate([
                'id'    => $key,
            ], [
                'name' => $value[0],
            ]);
            $role->syncPermissions($value[1]);
            // $role->syncPermissions($rolePermissions);
        }
    }
}
