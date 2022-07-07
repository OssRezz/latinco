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
        Schema::create('transcripciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incapacidad_id');
            $table->date('fechaActualizacion');
            $table->date('fechaPago')->nullable();
            $table->integer('valorRecuperado')->nullable();
            $table->integer('valorPendiente');
            $table->timestamps();
            $table->foreign('incapacidad_id')
                ->references('id')->on('incapacidades');
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transcripciones');
    }
};
