<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrador = new Rol();
        $administrador->rol = 'Administrador';
        $administrador->save();

        $usuarios = new Rol();
        $usuarios->rol = 'Usuario';
        $usuarios->save();

        $sst = new Rol();
        $sst->rol = 'Gestion Humana';
        $sst->save();

        $flujoCaja = new Rol();
        $flujoCaja->rol = 'Seguimiento y control';
        $flujoCaja->save();


        $costoLaboral = new Rol();
        $costoLaboral->rol = 'Flujo de caja';
        $costoLaboral->save();

        $contabilidad = new Rol();
        $contabilidad->rol = 'Contabilidad';
        $contabilidad->save();
    }
}
