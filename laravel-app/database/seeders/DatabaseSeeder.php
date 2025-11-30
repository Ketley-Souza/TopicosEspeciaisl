<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Categoria;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@livraria.local',
            'password' => Hash::make('123456'),
        ]);

        Categoria::create(['nome'=>'Ficção','descricao'=>'Livros de ficção']);
        Categoria::create(['nome'=>'Tecnologia','descricao'=>'TI e afins']);
        Categoria::create(['nome'=>'Infantil','descricao'=>'Livros infantis']);
    }
}
