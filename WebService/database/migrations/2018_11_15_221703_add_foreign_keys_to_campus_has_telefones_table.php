<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCampusHasTelefonesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('campus_has_telefones', function(Blueprint $table)
		{
			$table->foreign('campus_nome')->references('nome')->on('campus')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('telefones_telefone')->references('idTelefone')->on('telefones')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('campus_has_telefones', function(Blueprint $table)
		{
			$table->dropForeign('campus_nome');
			$table->dropForeign('telefones_telefone');
		});
	}

}
