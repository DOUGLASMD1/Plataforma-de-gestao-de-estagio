<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunosHasEnderecosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alunos_has_enderecos', function(Blueprint $table)
		{
			$table->string('alunos_rga', 20);
			$table->integer('enderecos_idendereco');
			$table->timestamps();
			$table->softDeletes();
			$table->primary(['alunos_rga','enderecos_idendereco']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('alunos_has_enderecos');
	}

}
