<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'user_id' => 1,
            'first_name' => 'nguyen',
            'last_name' => 'staff',
            'join_date' => '2021-01-01',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('123456'),
            'role' => UserRole::STAFF,
        ]);
        User::create([
            'user_id' => 2,
            'first_name' => 'nguyen',
            'last_name' => 'manager',
            'join_date' => '2021-01-01',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('123456'),
            'role' => UserRole::MANAGER,
        ]);
        User::create([
            'user_id' => 3,
            'first_name' => 'nguyen',
            'last_name' => 'approver',
            'join_date' => '2021-01-01',
            'email' => 'approver@gmail.com',
            'password' => bcrypt('123456'),
            'role' => UserRole::APPROVER,
        ]);
    }
}
