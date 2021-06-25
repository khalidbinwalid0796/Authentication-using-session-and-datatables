<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(10)->for(Brand::factory())->for(Category::factory())->create();
        //belongs to ty for,1 brand 10, 1 category 10 product
        //product seeder run korle brand,product,category te data insert hobe
    }
}
