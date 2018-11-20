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
			$table->foreign('coor_siape')->references('SIAPE')->on('coordenadores')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('aluno_rga')->references('rga')->on('alunos')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('super_users_cpf')->references('users_cpf')->on('supervisores')->onUpdate('CASCADE')->onDelete('CASCADE');
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
			$table->dropForeign('coor_siape');
			$table->dropForeign('aluno_rga');
			$table->dropForeign('super_users_cpf');
		});
	}

}
