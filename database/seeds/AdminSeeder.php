<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name'    => 'System',
            'Last_name'     => 'Administrator',
            'username'      => 'sys_admin',
            'email'         => 'sysadmin@system.admin',
            'password'      => Hash::make('secret'),
            'role'          => 'Administrator'
        ]);
    }
}
