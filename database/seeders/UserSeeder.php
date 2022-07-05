<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {      

        $users = [
            [      
                'nombres'            => 'Latinco',
                'apellidos'          => 'Administrador',
                'email'              => 'latinco@admin.com',
                'email_verified_at'  => now(),
                'password'           => bcrypt('1234'),
                'estado'             => '1',
                'rol_id'             => '1',
                'remember_token'     => null,
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [      
                'nombres'            => 'Latinco',
                'apellidos'          => 'User',
                'email'              => 'latinco@user.com',
                'email_verified_at'  => now(),
                'password'           => bcrypt('1234'),
                'estado'             => '1',
                'rol_id'             => '2',
                'remember_token'     => null,
                'created_at'         => now(),
                'updated_at'         => now(),
            ],


        ];

        User::insert($users);
    }
}
