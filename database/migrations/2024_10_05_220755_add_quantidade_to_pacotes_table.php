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
        Schema::table('pacotes', function (Blueprint $table) {
            $table->integer('quantidade')->after('tipo'); // Adiciona a coluna 'quantidade'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pacotes', function (Blueprint $table) {
            $table->dropColumn('quantidade'); // Remove a coluna 'quantidade'
        });
    }
};
    
