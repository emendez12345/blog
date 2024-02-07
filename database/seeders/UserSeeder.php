<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'full_name'=>'Paola Cabrera',
            'email'=>'paolatest@gmail.com',
            'password'=>Hash::make('Unico*123'),
        ]);

        User::create([
            'full_name'=>'Mary Vanegas',
            'email'=>'maryvanegas@gmail.com',
            'password'=>Hash::make('Unico*123'),
        ]);

        User::factory(10)->create();
    }
}
