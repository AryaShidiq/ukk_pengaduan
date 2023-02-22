<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ['id' => 1, 'name' => 'Lainnya', 'slug' => 'lainnya', 'status' => 'p', 'add_by' => 1, 'edit_by' => 2],
            ['id' => 2, 'name' => 'Lalu Lintas', 'slug' => 'lalu-lintas', 'status' => 'p', 'add_by' => 2, 'edit_by' => 1],
            ['id' => 3, 'name' => 'Sampah', 'slug' => 'sampaj', 'status' => 'h', 'add_by' => 2, 'edit_by' => 1],
            ['id' => 4, 'name' => 'Lingkungan', 'slug' => 'lingkungan', 'status' => 'h', 'add_by' => 1, 'edit_by' => 2],
            ['id' => 5, 'name' => 'Kemacetan', 'slug' => 'kemacetan', 'status' => 'p', 'add_by' => 2, 'edit_by' => 1],
            ['id' => 6, 'name' => 'Tindak Kriminal', 'slug'=> 'tindak-kriminal','status' => 'h', 'add_by' => 1, 'edit_by' => 2],
            ['id' => 7, 'name' => 'Banjir', 'slug' => 'banjir', 'status' => 'h', 'add_by' => 2, 'edit_by' => 1],
            ['id' => 8, 'name' => 'Layanan Darurat', 'slug' => 'layanan-darurat' , 'status' => 'p', 'add_by' => 1, 'edit_by' => 2],
        ];

        foreach($categories as $category){
            Category::create($category);
        }
        

    }
}
