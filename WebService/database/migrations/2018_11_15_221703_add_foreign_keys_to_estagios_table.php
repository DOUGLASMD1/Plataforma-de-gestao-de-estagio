<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEstagiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('estagios', function(Blueprint $table)
		{
			$table->foreign('alunos_rga')->references('rga')->on('alunos')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('coordenadores_SIAPE')->references('SIAPE')->on('coordenadores')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('supervisor')->references('users_cpf')->on('supervisores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('estagios', function(Blueprint $table)
		{
			$table->dropForeign('alunos_rga');
			$table->dropForeign('coordenadores_SIAPE');
			$table->dropForeign('supervisor');
		});
	}

}
