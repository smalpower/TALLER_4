<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('egresados', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('apellido');
        $table->string('cedula')->unique();
        $table->string('celular');
        $table->string('correo')->unique();
        $table->string('ciudad');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egresados');
    }
};
