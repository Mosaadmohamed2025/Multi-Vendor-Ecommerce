<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'title' => $this->faker->sentence(3 , false),
                'slug' => $this->faker->unique()->slug,
                'summary' => $this->faker->sentence(2 , false),
                'description' => $this->faker->paragraphs(3 , true),
                'additional_info' => $this->faker->paragraphs(3 , true),
                'return_cancellation' => $this->faker->paragraphs(3 , true),
                'stock' => $this->faker->numberBetween(2, 10),
                'brand_id' => $this->faker->randomElement(Brand::pluck('id')->toArray()),
                'vendor_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
                'cat_id' => $this->faker->randomElement(Category::where('is_parent', 1)->pluck('id')->toArray()),
                'child_cat_id' => $this->faker->randomElement(Category::pluck('id')->toArray()),

                'photo' => $this->faker->imageUrl(255 , 274),
                'size_guide' => $this->faker->imageUrl(80 , 80),
                'price' => $this->faker->randomFloat(2, 0, 1000),
                'offer_price' => $this->faker->randomFloat(2, 0, 1000),
                'discount' => $this->faker->randomFloat(2, 0, 1000),
                'size' => $this->faker->randomElement(['S', 'M', 'L' , 'XL']),
                'conditions' => $this->faker->randomElement(['new', 'popular', 'winter']),
                'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
