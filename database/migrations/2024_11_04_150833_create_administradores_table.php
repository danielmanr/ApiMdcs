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
        Schema::create('administradores', function (Blueprint $table) {
            $table->id('Id_Administrador');
            $table->string('Nombre_Administrador');
            $table->string('Apellido_Administrador');
            $table->string('Numero_Documento_Administrador')->unique();
            $table->boolean('EsSuperAdmin');
            $table->string('Usuario')->unique();
            $table->string('Contrasena');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administradores');
    }
};
