<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
            'id'   => 1,
            'name' => 'Medishop'
        ]);

        Branch::create([
            'id'   => 2,
            'name' => 'Semarang'
        ]);

        Branch::create([
            'id'   => 3,
            'name' => 'Salatiga'
        ]);
    }
}
