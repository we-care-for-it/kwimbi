<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use App\Models\ObjectBuildingType;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superAdmin@digilevel.nl',
            'password' => bcrypt('M9kKhE2tl7'),
        ]);

        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superAdmin@digilevel.nl',
            'password' => bcrypt('M9kKhE2tl7'),
        ]);

 

        ObjectBuildingType::insert([

            [
                'name' => 'Administrator',
                'is' => 'admin@app.com',
                'password' => bcrypt('password'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Agency',
                'email' => 'agency@app.com',
                'password' => bcrypt('password'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'End',
                'email' => 'endcustomer@app.com',
                'password' => bcrypt('password'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ]);



        $this->call(ShieldSeeder::class);
        $this->command->call('shield:generate', ['--panel' => 'Admin', '--all' => 'true',  ]);
        $this->command->call('shield:super-admin', ['--user' => $superAdmin->id, '--panel' => 'Admin']);
    }
}
