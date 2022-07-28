<?php

namespace Database\Seeders;

use App\Models\Diagnostico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiagnosticoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diagnostico = [
            [
                'diagnostico'             => 'Z302',
            ],
            [
                'diagnostico'             => 'L031',
            ],
            [
                'diagnostico'             => 'S801',
            ],
            [
                'diagnostico'             => 'S834',
            ],
            [
                'diagnostico'             => 'S300',
            ],
            [
                'diagnostico'             => 'M542',
            ],
            [
                'diagnostico'             => 'S600',
            ],
            [
                'diagnostico'             => 'S929',
            ],
            [
                'diagnostico'             => 'M795',
            ],
            [
                'diagnostico'             => 'S601',
            ],
            [
                'diagnostico'             => 'L039',
            ],
            [
                'diagnostico'             => 'M751',
            ],
        ];

        Diagnostico::insert($diagnostico);
    }
}
