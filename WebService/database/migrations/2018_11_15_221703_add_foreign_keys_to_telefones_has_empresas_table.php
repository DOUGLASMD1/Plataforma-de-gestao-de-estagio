<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTelefonesHasEmpresasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('telefones_has_empresas', function(Blueprint $table)
		{
			$table->foreign('empresas_cnpj')->references('cnpj')->on('empresas')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('telefones_telefone')->references('telefone')->on('telefones')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('telefones_has_empresas', function(Blueprint $table)
		{
			$table->dropForeign('empresas_cnpj');
			$table->dropForeign('telefones_telefone');
		});
	}

}
