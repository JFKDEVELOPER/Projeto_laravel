<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodigoAndStatusToPacotesTable extends Migration
{
    public function up()
{
    Schema::table('pacotes', function (Blueprint $table) {
        $table->string('codigo', 4); // Adiciona a coluna 'codigo' sem a restrição unique
        $table->string('status')->default('estoque'); // Adiciona a coluna 'status' com valor padrão 'estoque'
    });
}


    public function down()
    {
        Schema::table('pacotes', function (Blueprint $table) {
            $table->dropColumn('codigo'); // Remove a coluna 'codigo'
            $table->dropColumn('status'); // Remove a coluna 'status'
        });
    }
}
