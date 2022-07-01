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
            $table->date('fechaTranscripcion');
            $table->string('numeroIncapacidad')->nullable();
            $table->date('fechaPago')->nullable();
            $table->string('quincenasNomina')->nullable();
            $table->integer('valorRecuperado')->nullable();
            $table->integer('valorPendiente')->nullable();
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
