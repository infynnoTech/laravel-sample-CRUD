<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //default records
        DB::table('users')->insert([
            [
               'name' => 'ShreeHari',
               'email' => 'shreehari@gmail.com',
               'password' => Hash::make('nikhil@0987'),
            ],
            [
               'name' => 'Nikhil',
               'email' => 'nikhil@gmail.com',
               'password' => Hash::make('nikhil@0987'),
           ]
        ]);

        $categoreis=[
            'Mobile',
            'Tablate',
        ];
        for($i=0;$i<count($categoreis);$i++){
                $category=DB::table('categories')->insertGetId([
                    'name' => $categoreis[$i],
                    'description' =>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '
                ]);

                $product=DB::table('products')->insertGetId([
                    'name' => 'One Plus 6T',
                    'category_id' => $category,
                    'price' => 38999,
                ]);

                $product_detail=DB::table('product_details')->insertGetId([
                    'product_id' => $product,
                    'color' => 1,
                    'height' => 1,
                    'width' => 1,
                    'weight' => 1,
                    'stock' => 100,
                    'description' =>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '
                ]);
        }
    }
}
