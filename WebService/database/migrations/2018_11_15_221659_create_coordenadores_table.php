<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoordenadoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coordenadores', function(Blueprint $table)
		{
			$table->integer('SIAPE');
			$table->string('Cargo', 25);
			$table->string('users_cpf', 45);
			$table->integer('cursos_codCurso');
			$table->timestamps();
			$table->softDeletes();
			$table->primary(['SIAPE','users_cpf']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('coordenadores');
	}

}
