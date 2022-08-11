<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'nama_makanan' => 'Nasi Padang', 'harga' => '12000', 'jenis_makanan' => 'Nasi', 'deskripsi' => 'Nasi padang', 'is_tersedia' => 1],
            ['id' => 2, 'nama_makanan' => 'Nasi Pecel', 'harga' => '6000', 'jenis_makanan' => 'Nasi', 'deskripsi' => 'Nasi pecel', 'is_tersedia' => 1],
            ['id' => 3, 'nama_makanan' => 'Nasi Mangut', 'harga' => '6000', 'jenis_makanan' => 'Nasi', 'deskripsi' => 'Nasi mangut', 'is_tersedia' => 1],
        ];

        DB::table('foods')->truncate();
        DB::table('foods')->insert($data);
    }
}
