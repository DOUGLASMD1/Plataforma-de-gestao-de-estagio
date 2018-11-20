<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVagasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vagas', function(Blueprint $table)
		{
			$table->integer('idVagas',true);
			$table->string('Titulo', 100);
			$table->string('Area', 100);
			$table->text('Requisitos_para_Vaga', 65535);
			$table->string('supervisor',45);
			$table->enum('status', array('A','E'));
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('vagas');
	}

}
