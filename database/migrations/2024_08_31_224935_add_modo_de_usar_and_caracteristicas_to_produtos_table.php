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
        Schema::table('produtos', function (Blueprint $table) {
            $table->string('modo_de_usar')->nullable(); // Adiciona o campo 'modo_de_usar' como string e permite valores nulos
            $table->json('caracteristicas')->nullable(); // Adiciona o campo 'caracteristicas' como JSON e permite valores nulos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('modo_de_usar'); // Remove o campo 'modo_de_usar'
            $table->dropColumn('caracteristicas'); // Remove o campo 'caracteristicas'
        });
    }
};
