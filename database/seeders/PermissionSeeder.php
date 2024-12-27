<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionList = [
            'voting view',
            'voting vote',
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

        for ($i = 0; $i < count($permissionList); $i++) {
            Permission::updateOrCreate([
                'id' => ($i + 1),
            ], [
                'name' => $permissionList[$i],
            ]);
        }
    }
}
