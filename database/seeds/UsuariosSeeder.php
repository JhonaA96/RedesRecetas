<?php

use App\User;
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

        $user = User::create([
            'name' => 'Jhonatan',
            'email' => 'correo@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://github.com/JhonaA96',
        ]);
        
        $user2 = User::create([
            'name' => 'Jhonatan Acuña Hernández',
            'email' => 'jonathan.961120@hotmail.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://github.com/JhonaA96',
        ]);


    }
}
