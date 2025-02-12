<?php
namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $superAdmin = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password'),
        ],
        );

        $company = Company::create([
            'name' => 'Bedrijf 1',
        ]);

        $department = DB::table('departments')->insert([
            ['name' => 'Boekhouding', 'company_id' => 1],
            ['name' => 'Salaris administratie', 'company_id' => 1],
            ['name' => 'Derectie', 'company_id' => 1],
        ]);

        $superAdmin->companies()->attach($company);

    }
}
