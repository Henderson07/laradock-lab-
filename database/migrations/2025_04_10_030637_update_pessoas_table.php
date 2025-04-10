<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pessoas', function (Blueprint $table) {
            // Adicionando nova coluna 'cpf/cnpj' para substituir cpf/cnpj
            $table->string('cpf/cnpj', 14)->nullable()->after('nome');

            // Adicionando coluna 'tipo' para diferenciar Pessoa Física e Jurídica
            $table->char('tipo', 1)->default('F')->after('cpf/cnpj');

            // Removendo colunas antigas
            $table->dropColumn(['cpf', 'cnpj']);
        });
    }

    public function down()
    {
        Schema::table('pessoas', function (Blueprint $table) {
            // Restaurando as colunas antigas
            $table->string('cpf', 11)->nullable();
            $table->string('cnpj', 14)->nullable();

            // Removendo colunas novas
            $table->dropColumn(['cpf/cnpj', 'tipo']);
        });
    }

}
