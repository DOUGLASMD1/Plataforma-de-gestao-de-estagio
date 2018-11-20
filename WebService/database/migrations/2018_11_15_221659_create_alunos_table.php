<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alunos', function(Blueprint $table)
		{
			$table->string('rga', 20);
			$table->string('semestreAtual', 45);
			$table->string('users_cpf', 45);
			$table->integer('cursos_codCurso');
			$table->timestamps();
			$table->softDeletes();
			$table->primary(['rga','users_cpf']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('alunos');
	}

}
