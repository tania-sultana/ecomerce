<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Category::create(['name'=>'Fruits & Vegetables','slug'=>'Fruits & Vegetables','description'=>'Fruits & Vegetables category','image'=>'files/Fruits & Vegetable.jpg']);
        Category::create(['name'=>'Meat & Fish','slug'=>'Meat & Fish','description'=>'Meat & Fish category','image'=>'files/Meat & Fish.jpg']); 
        Category::create(['name'=>'Cooking Essentials','slug'=>'Cooking Essentials','description'=>'Cooking Essentials category','image'=>'files/Cooking Essentials.jpg']);
        Category::create(['name'=>'Sauces & Pickles','slug'=>'Sauces & Pickles','description'=>'Sauces & Pickles category','image'=>'files/sauces & pickles.jpg']);
        Category::create(['name'=>'Bread,Biscuits & Cake','slug'=>'Bread,Biscuits & Cake','description'=>'Bread,Biscuits & Cake category','image'=>'files/bread,biscuits & cake.jpg']);
        Category::create(['name'=>'Baby food & care','slug'=>'Baby food & care','description'=>'Baby food & care category','image'=>'files/baby food & care.jpg']);

        Subcategory::create(['name'=>'Fruits','category_id'=>1]);
        Subcategory::create(['name'=>'Vegetables','category_id'=>1]);
        Subcategory::create(['name'=>'Dry fruits & vegetables','category_id'=>1]);

        /*Product::create([
            'name'=>'Apple Gala',
            'image'=>'products/apple gala.jpg',
            'price'=>250,
            'description'=>'Apple per kg',
            'additional_info'=>'Fresh fruits',
            'category_id'=> 1,
            'subcategory_id'=>1
        ]);
        Product::create([
            'name'=>'Apple Gala',
            'image'=>'products/apple gala.jpg',
            'price'=>250,
            'description'=>'Apple per kg',
            'additional_info'=>'Fresh fruits',
            'category_id'=> 1,
            'subcategory_id'=>1
        ]);*/
       
    }
}
