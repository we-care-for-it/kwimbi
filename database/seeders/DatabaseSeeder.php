<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'SuperAdmin@liftbeheer.nl',
            'password' => bcrypt('password'),
        ]);

        $company = Company::create([
            'name' => 'Liftbeheer',
        ]);

        $superAdmin->companies()->attach($company);

        $this->call(ShieldSeeder::class);
        $this->command->call('shield:generate', ['--all' => true]);
        $this->command->call('shield:super-admin', ['--user' => $superAdmin->id]);

        //$this->call(LocationSeeder::class);
       // $this->call(AssetSeeder::class);
    }
}
