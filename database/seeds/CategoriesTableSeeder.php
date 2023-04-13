<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
         	'category_name'=>'Flat',
        ]);
        DB::table('categories')->insert([
         	'category_name'=>'Duplex House',
        ]);
        DB::table('categories')->insert([
         	'category_name'=>'Apartment',
        ]);
        DB::table('categories')->insert([
         	'category_name'=>'Rest House',
        ]);
        DB::table('categories')->insert([
         	'category_name'=>'Flat with furniture',
        ]);
         DB::table('categories')->insert([
         	'category_name'=>'Flat with furniture and Ac',
        ]);
    }
}
