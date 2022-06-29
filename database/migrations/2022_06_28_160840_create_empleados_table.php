<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 20)->unique();
            $table->string('nombre', 150);
            $table->date('fechaIngreso');
            $table->date('fechaRetiro');
            $table->tinyInteger('estado');
            $table->integer('salario');
            $table->unsignedBigInteger('fkCo');
            $table->unsignedBigInteger('fkCargo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
};
