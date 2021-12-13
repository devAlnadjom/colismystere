<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(4)->create();

         Product::factory(30)->create();
         Category::factory(8)->create();

         $categories= Category::all();

         Product::all()->each(function($product) use($categories){
            $product->categories()->attach(
                $categories->random(2)->pluck('id')->toArray()
            );
         });
    }
}
