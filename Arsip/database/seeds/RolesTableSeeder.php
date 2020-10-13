<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create([
            'name' => 'super admin',
        ]);

        $admin = Role::create([
            'name' => 'admin',
        ]);

        $user = User::find(1);
        $user->roles()->attach($superAdmin);
        $user->roles()->attach($admin);
    }
}
