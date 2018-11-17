<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSupervisoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('supervisores', function(Blueprint $table)
		{
			$table->foreign('users_cpf')->references('cpf')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('empresas_cnpj')->references('cnpj')->on('empresas')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('supervisores', function(Blueprint $table)
		{
			$table->dropForeign('users_cpf');
			$table->dropForeign('empresas_cnpj');
		});
	}

}
