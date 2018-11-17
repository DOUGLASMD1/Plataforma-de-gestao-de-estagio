<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEmpresasHasEnderecosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('empresas_has_enderecos', function(Blueprint $table)
		{
			$table->foreign('emp_cnpj')->references('cnpj')->on('empresas')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('enderecos_idendereco')->references('idendereco')->on('enderecos')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('empresas_has_enderecos', function(Blueprint $table)
		{
			$table->dropForeign('emp_cnpj');
			$table->dropForeign('enderecos_idendereco');
		});
	}

}
