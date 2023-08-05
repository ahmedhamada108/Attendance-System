<?php

namespace Database\Seeders;

use App\Models\heads;
use Illuminate\Database\Seeder;

class HeadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        heads::create([
            'name' => 'head',
            'email' => 'head@head.com',
            'password' => bcrypt('password'),
        ]);
    }
}
