<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'user_id' => 1,
            'first_name' => 'nguyen',
            'last_name' => 'staff',
            'join_date' => '2021-01-01',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('123456'),
            'start_time_working' => '8:30',
            'end_time_working' => '17:30',
            'role' => UserRole::STAFF,
        ]);
        
        User::create([
            'user_id' => 2,
            'first_name' => 'nguyen',
            'last_name' => 'manager',
            'join_date' => '2021-01-01',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('123456'),
            'start_time_working' => '8:30',
            'end_time_working' => '17:30',
            'role' => UserRole::MANAGER,
        ]);
        User::create([
            'user_id' => 3,
            'first_name' => 'nguyen',
            'last_name' => 'approver',
            'join_date' => '2021-01-01',
            'email' => 'approver@gmail.com',
            'password' => bcrypt('123456'),
            'start_time_working' => '8:30',
            'end_time_working' => '17:30',
            'role' => UserRole::APPROVER,
        ]);
    }
}
