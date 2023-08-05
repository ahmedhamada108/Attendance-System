<?php

namespace Database\Seeders;

use App\Models\departments;
use App\Models\heads;
use Illuminate\Database\Seeder;

class DepartmentsSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'category 1',
                'head_id' => 1
            ],
            [
                'name' => 'category 2',
                'head_id' => 1
            ],
            [
                'name' => 'category 3',
                'head_id' => 1
            ]
        ];
        departments::insert($data);
    }
}