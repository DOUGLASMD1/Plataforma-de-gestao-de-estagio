<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlunosHasVagasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('alunos_has_vagas', function(Blueprint $table)
		{
			$table->foreign('alunos_rga')->references('rga')->on('alunos')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('vagas_idVagas')->references('idVagas')->on('vagas')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('alunos_has_vagas', function(Blueprint $table)
		{
			$table->dropForeign('alunos_rga');
			$table->dropForeign('vagas_idVagas');
		});
	}

}
