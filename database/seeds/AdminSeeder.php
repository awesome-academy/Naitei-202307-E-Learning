<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::unguard();

        User::create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123123'),
            'name' => 'Admin',
            'dob' => '1999-01-01',
            'gender' => 'male',
            'phone_number' => '0123456789',
            'role' => config('constant.role.admin'),
            'status' => config('constant.status.active')
        ]);
    }
}
