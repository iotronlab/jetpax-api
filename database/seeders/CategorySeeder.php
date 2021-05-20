<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id'    => 2,
                "category_name"  =>"Health and Fitness"
            ],
            [
                'id'    => 3,
                "category_name"  =>"Beauty and Cosmetics",
            ],
            [
                'id'    => 4,
                "category_name"  =>"Travel",
            ],
            [
                'id'    => 5,
                "category_name"  =>"Gaming and Technology",
            ],
            [
                'id'    => 6,
                "category_name"  =>"Food",
            ],
            [
                'id'    => 7,
                "category_name"  =>"Automobile",
            ],
            [
                'id'    => 8,
                "category_name"  =>"Education",
            ],
            [
                'id'    => 9,
                "category_name"  =>"Entertainment",
            ],
            [
                'id'    => 10,
                "category_name"  =>"Others",
            ]
        ];
        foreach($categories as $category){
            Category::create($category);
        };
    }
}
