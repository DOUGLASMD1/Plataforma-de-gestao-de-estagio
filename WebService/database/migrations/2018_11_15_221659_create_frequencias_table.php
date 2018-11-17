<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFrequenciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('frequencias', function(Blueprint $table)
		{
			$table->increments('idFrequencia', true);
			$table->dateTime('Data_inicio');
			$table->dateTime('data_fim');
			$table->text('Descricao_aluno', 65535);
			$table->text('Descricao_Supervisor', 65535)->nullable();
			$table->enum('status', array('A','P'))->nullable();
			$table->integer('estagio_idestagio');
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
		Schema::drop('frequencias');
	}

}
