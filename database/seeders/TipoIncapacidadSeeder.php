<?php

namespace Database\Seeders;

use App\Models\TipoIncapacidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoIncapacidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo = new TipoIncapacidad();
        $tipo->tipo = 'Incapacidad general';
        $tipo->save();
    }
}
