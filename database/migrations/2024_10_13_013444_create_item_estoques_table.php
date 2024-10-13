<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up()
    {
        Schema::table('pacotes', function (Blueprint $table) {
            // Remova a linha abaixo, pois 'codigo' já existe
            // $table->string('codigo')->unique(); // Se essa linha existir, comente ou remova
           
            // Verifique se a coluna 'status' já existe antes de adicioná-la
            if (!Schema::hasColumn('pacotes', 'status')) {
                $table->string('status')->default('estoque'); // Adiciona apenas a coluna 'status'
            }
        });
    }
    
    public function down()
    {
        Schema::table('pacotes', function (Blueprint $table) {
            $table->dropColumn('status'); // Remove a coluna 'status' ao desfazer a migração
            // Se você adicionar uma condição para adicionar 'codigo', faça o mesmo aqui para removê-la
            // $table->dropColumn('codigo'); // Remova se não quiser que essa coluna seja removida ao desfazer a migração
        });
    }
    
    
};
