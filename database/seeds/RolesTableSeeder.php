<?php

use Illuminate\Database\Seeder;

use App\Role;
use App\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
        $role_user->name = "User";
        $role_user->description = "Default User";
        $role_user->save();

        $role_admin = new Role();
        $role_admin->name = "Administrator";
        $role_admin->description = "Administrator";
        $role_admin->save();
    }
}
