<?php

namespace Database\Seeders;

use App\Models\AssetBrand;
use App\Models\AssetCategory;
use App\Models\AssetModel;
use App\Models\Company;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        // $categories = AssetCategory::factory()->count(10)->create([
        //     'company_id' => Company::all()->first()->id,
        // ]);

        // $brands = AssetBrand::factory()->count(rand(5, 10))->create([
        //     'company_id' => Company::all()->first()->id,
        // ]);

        // $brands->each(function ($brand) use ($categories) {
        //     for ($i = 0; $i < rand(5, 10); $i++) {
        //         AssetModel::factory()->create([
        //             'brand_id' => $brand->id,
        //             'category_id' => $categories->random()->id,
        //         ]);
        //     }
        // });
    }
}
