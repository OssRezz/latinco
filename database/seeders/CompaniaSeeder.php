<?php

namespace Database\Seeders;

use App\Models\Compania;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comapania = new Compania();
        $comapania->nombre = "Latinco";
        $comapania->tipoCompania = 1;
        $comapania->save();
    }
}
