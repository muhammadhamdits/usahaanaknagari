<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama' => "Halim Wardana",
            'username' => "halim",
            'password' => Hash::make('halim'),
            'status' => 1,
        ]);
        DB::table('jenis_usaha')->insert(['nama' => "Barang"]);
        DB::table('jenis_usaha')->insert(['nama' => "Jasa"]);
        DB::table('jenis_usaha')->insert(['nama' => "Lainnya"]);
    }
}
