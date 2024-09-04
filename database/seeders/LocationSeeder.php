<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $location = Location::create([
            'name' => 'Headquarters',
            'company_id' => Company::all()->first()->id,
        ]);

        $deskIndex = 1;

        foreach (['Management', 'Sales', 'Marketing'] as $department) {
            $department = $location->departments()->create([
                'name' => $department,
            ]);

            for ($i = 1; $i <= 5; $i++) {
                $department->workspaces()->create([
                    'name' => "WP-{$deskIndex}",
                ]);

                $deskIndex++;
            }
        }
    }
}
