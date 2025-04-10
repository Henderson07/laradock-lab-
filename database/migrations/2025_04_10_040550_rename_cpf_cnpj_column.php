<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCpfCnpjColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pessoas', function (Blueprint $table) {
            $table->string('cpf_cnpj', 14)->nullable()->after('nome'); // Cria a nova coluna
        });

        // Copiar os dados antigos da coluna cpf/cnpj para a nova cpf_cnpj
        DB::statement("UPDATE pessoas SET cpf_cnpj = `cpf/cnpj`");
    }

    public function down()
    {
        Schema::table('pessoas', function (Blueprint $table) {
            $table->dropColumn('cpf_cnpj'); // Remove a nova coluna se necessário
        });
    }


}
