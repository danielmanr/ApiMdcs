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
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id('Id_Medicamento'); // Llave primaria
            $table->string('Nombre');
            $table->string('Concentracion');
            $table->string('CodigoBarras');

            $table->unsignedBigInteger('tipoMedicamento_Id');
            $table->foreign('tipoMedicamento_Id')
                ->references('Id_TipoMedicamento')
                ->on('tipo_medicamentos')
                ->onDelete('cascade');

            $table->foreignId('Id_Laboratorio')
                ->nullable()
                ->constrained('laboratorios','Id_Laboratorio')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos');
    }
};
