<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToArquivosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('arquivos', function(Blueprint $table)
		{
			$table->foreign('alunos_rga')->references('rga')->on('alunos')->onUpdate('CASCADE')->onDelete('CASCADE');
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
		Schema::table('arquivos', function(Blueprint $table)
		{
			$table->dropForeign('alunos_rga');
			$table->dropForeign('supervisor');
		});
	}

}
