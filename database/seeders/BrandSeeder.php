<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::factory()->count(10)->has(Product::factory()->count(2))->create();
        //1 ta brands ar jonno 2 ta product insert hobe
        //brand seeder run korle brand,product,category te data insert hobe
    }
}
