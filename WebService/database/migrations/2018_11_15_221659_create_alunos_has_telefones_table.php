<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunosHasTelefonesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alunos_has_telefones', function(Blueprint $table)
		{
			$table->string('alunos_rga', 20);
			$table->integer('telefones_telefone');
			$table->timestamps();
			$table->softDeletes();
			$table->primary(['alunos_rga','telefones_telefone']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('alunos_has_telefones');
	}

}
