<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Department;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::factory()->has(
            Category::factory()->has(
                Subcategory::factory()->has(
                    Product::factory()->count(5)
                )->count(2)
            )->count(2)
        )->count(2)->create();
    }
}
