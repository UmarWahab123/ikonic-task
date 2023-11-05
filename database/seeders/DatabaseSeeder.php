<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Feedback;
use App\Models\GeneralSetting;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        $adminUser = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'role_id'=>1,
        ]);
       $product= Product::create([
            'product_title'=>'product tilte',
           'product_price'=>1343,
            'product_description'=>'description of the product',
            'product_image'=>'product1.jpeg'
        ]);
        Feedback::create([

            'category'=>'Improment',
            'description'=>'description',
            'title'=>'title',
            'product_id'=>$product->id,
            'user_id'=>$adminUser->id,
        ]);
        GeneralSetting::create([
            'logo'=>'logo.png',
            'favicon'=>'favicon.png',
            'site_name'=>'Product feedback',
            'phone_no'=>"0324324324324",
            'email'=>'usrmar@gmail.com  ',
            'copyright'=>'product feedback',
        ]);
        $userSeeder = \App\Models\User::factory()->create([
            'name' => ' User',
            'email' => 'umarwahab672@gmail.com',
            'role_id'=>2
        ]);


    }
}
