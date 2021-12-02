<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'Martin',
            'email'=> 'correo@correo.com',
            'password'=> Hash::make('12345678'),
            'url'=> 'http://codigoconmartin.com',
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name'=> 'Maquino',
            'email'=> 'maquino@maquino.com',
            'password'=> Hash::make('12345678'),
            'url'=> 'http://codigoconmaquino.com',
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);
    }
}
