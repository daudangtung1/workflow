<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkingPart;

class WorkingPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkingPart::create([
            'name' => 'IT事業部',
            'branch_id' => 0,
        ]);

        WorkingPart::create([
            'name' => 'marketing事業部',
            'branch_id' => 0
        ]);
    }
}
