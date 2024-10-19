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
        Schema::create('medicamentos_usuarios', function (Blueprint $table) {
            $table->unsignedBigInteger('medicamento_id'); // Asegúrate de que esto coincida con la migración de medicamentos
            $table->unsignedBigInteger('usuario_id'); // Asegúrate de que esto coincida con la migración de historial
            $table->date('fechaConsulta'); // Agregar fechaConsulta aquí


            // Definir las claves foráneas
            $table->foreign('medicamento_id')->references('Id_Medicamento')->on('medicamentos')->onDelete('cascade');
            $table->foreign('usuario_id')->references('Id_Usuario')->on('usuarios')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos_usuarios');
    }
};
