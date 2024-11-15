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
        Schema::table('reportemedicamentos', function (Blueprint $table) {
            $table->string('U_Uid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reportemedicamentos', function (Blueprint $table) {
            $table->dropColumn('U_Uid');
        });
    }
};
