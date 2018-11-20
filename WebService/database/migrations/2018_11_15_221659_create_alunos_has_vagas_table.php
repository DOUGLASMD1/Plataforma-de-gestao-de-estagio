<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunosHasVagasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alunos_has_vagas', function(Blueprint $table)
		{
			$table->string('alunos_rga', 20);
			$table->integer('vagas_idVagas');
			$table->enum('status', array('A','EA','R'));
			$table->timestamps();
			$table->softDeletes();
			$table->primary(['alunos_rga','vagas_idVagas']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('alunos_has_vagas');
	}

}
