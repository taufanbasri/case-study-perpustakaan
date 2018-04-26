<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat role Admin
        $roleAdmin = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin'
        ]);

        // Membuat role Member
        $roleMember = Role::create([
            'name' => 'member',
            'display_name' => 'Member'
        ]);

        // Contoh user dengan role Admin
        $adminUser = User::create([
            'name' => 'Admin Tamvan',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123456'),
            'is_verified' => 1
        ]);

        $adminUser->attachRole($roleAdmin);

        // Contoh user dengan role Member
        $memberUser = User::create([
            'name' => 'Member Soleha',
            'email' => 'member@mail.com',
            'password' => bcrypt('123456'),
            'is_verified' => 1
        ]);

        $memberUser->attachRole($roleMember);
    }
}
