<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlunosHasEnderecosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('alunos_has_enderecos', function(Blueprint $table)
		{
			$table->foreign('alunos_rga')->references('rga')->on('alunos')->onUpdate('CASCADE')->onDelete('CASCADE');
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
		Schema::table('alunos_has_enderecos', function(Blueprint $table)
		{
			$table->dropForeign('alunos_rga');
			$table->dropForeign('enderecos_idendereco');
		});
	}

}
