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
        $user = new User();
        $user->name = 'Latinco Administrador';
        $user->email = 'latinco@latinco.com';
        $user->email_verified_at = now();
        $user->password = '$2a$12$n8DFuRU4BrU8bls6AAcsfua0qkEijpThCdPv2rjmQyJsCV3hDv50a'; //Password: 1234
        $user->fkRol = 1;
        $user->remember_token = Str::random(10);
        $user->save();
    }
}
