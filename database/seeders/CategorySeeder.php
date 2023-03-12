<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Masyarakat;
use App\Models\Petugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $petugas = [
        //     ['id_petugas' => 1, 'nama_petugas' => 'Admin', 'email' => 'admin@gmail.com', 'telp' => 983497384754, 'password' => Hash::make(12345678), 'level' => 'admin'],
        //     ['id_petugas' => 2, 'nama_petugas' => 'Petugas', 'email' => 'petugas@gmail.com', 'telp' => 230984737283, 'password' => Hash::make(12345678), 'level' => 'petugas'],
        // ];

        // foreach($petugas as $petuga){
        //     Petugas::create($petuga);
        // }
        
        // $masyarakats = [
        //     ['id' => 1, 'nama' => 'Radit', 'email' => 'radit@gmail.com', 'telp' => 983497384754, 'password' => Hash::make(12345678), 'nik' => '9837849187463456'],
        //     ['id' => 2, 'nama' => 'Budi', 'email' => 'budi@gmail.com', 'telp' => 983497384754, 'password' => Hash::make(12345678), 'nik' => '1298746532875674'],
        //     ['id' => 3, 'nama' => 'Sigit', 'email' => 'sigit@gmail.com', 'telp' => 230984737283, 'password' => Hash::make(12345678), 'nik' => '9832298776534567'],
        // ];

        // foreach($masyarakats as $masyarakat){
        //     Masyarakat::create($masyarakat);
        // }

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
