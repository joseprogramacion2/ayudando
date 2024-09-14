<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('Codigo');
            $table->string('Empresa_Cliente');
            $table->string('Correo_Electronico');
            $table->string('Estado');
            $table->string('Telefono');
            $table->string('Patente')->nullable();
            $table->string('RTU')->nullable();
            $table->string('DPI')->nullable();
            $table->string('Tipo_Cliente');
            $table->string('Departamento');
            $table->string('Municipio');
            $table->string('Completar_Direccion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
