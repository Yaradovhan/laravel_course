<?php

use App\Entity\Adverts\Category as CategoryAlias;
use Illuminate\Database\Seeder;

class AdvertsCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CategoryAlias::class, 10)->create()->each(function (CategoryAlias $category){
           $counts = [0, random_int(3,7)];
           $category->children()->saveMany(factory(CategoryAlias::class, $counts[array_rand($counts)])->create()->each(function (CategoryAlias $category){
               $counts = [0, random_int(3,7)];
               $category->children()->saveMany(factory(CategoryAlias::class, $counts[array_rand($counts)])->create());
           }));
        });
    }
}
