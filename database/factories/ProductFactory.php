<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->unique()->name(),
            'product_code' => rand(1111,9999),
            'brand_id' => Brand::factory(),
            'category_id' => Category::factory(),
            'price' => rand(10,200),
            'qty' => rand(10,200),
            'min_qty' => rand(10,200),
            'max_qty' => rand(10,200),
        ];
    }
}
