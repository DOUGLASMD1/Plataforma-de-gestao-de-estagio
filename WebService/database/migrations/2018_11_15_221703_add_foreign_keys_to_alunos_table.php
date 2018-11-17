<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlunosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('alunos', function(Blueprint $table)
		{
			$table->foreign('users_cpf')->references('cpf')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('cursos_codCurso')->references('codCurso')->on('cursos')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('alunos', function(Blueprint $table)
		{
			$table->dropForeign('users_cpf');
			$table->dropForeign('cursos_codCurso');
		});
	}

}
