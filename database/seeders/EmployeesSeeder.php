<?php

namespace Database\Seeders;

use App\Models\departments;
use App\Models\employees;
use App\Models\heads;
use Illuminate\Database\Seeder;

class EmployeesSeeder extends Seeder
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
                'name' => 'employee 1',
                'email' => 'employee1@employee.com',
                'password' => bcrypt('password'),
                'department_id' => 1,
                'status'=> 1
            ],
            [
                'name' => 'employee 2',
                'email' => 'employee2@employee.com',
                'password' => bcrypt('password'),
                'department_id' => 1,
                'status'=> 1
            ],
            [
                'name' => 'employee 3',
                'email' => 'employee3@employee.com',
                'password' => bcrypt('password'),
                'department_id' => 2,
                'status'=> 1
            ],
            [
                'name' => 'employee 4',
                'email' => 'employee4@employee.com',
                'password' => bcrypt('password'),
                'department_id' => 2,
                'status'=> 1
            ]
        ];
        employees::insert($data);
    }
}