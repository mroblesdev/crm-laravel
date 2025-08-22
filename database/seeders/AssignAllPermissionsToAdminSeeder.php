<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssignAllPermissionsToAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(1);
        if ($user) {
            $permissionIds = Permission::pluck('id')->toArray();
            $user->permissions()->sync($permissionIds);
        }
    }
}
