<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlunosHasTelefonesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('alunos_has_telefones', function(Blueprint $table)
		{
			$table->foreign('alunos_rga')->references('rga')->on('alunos')->onUpdate('CASCADE')->onDelete('CASCADE');
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
		Schema::table('alunos_has_telefones', function(Blueprint $table)
		{
			$table->dropForeign('alunos_rga');
			$table->dropForeign('telefones_telefone');
		});
	}

}
