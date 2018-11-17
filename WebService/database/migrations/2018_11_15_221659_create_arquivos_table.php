<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArquivosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arquivos', function(Blueprint $table)
		{
			$table->integer('idarquivo', true);
			$table->enum('tipo_arquivo', array('TC','PA','RFA','RFS'));
			$table->binary('arquivo');
			$table->string('alunos_rga', 20);
			$table->string('supervisor',45)->nullable();
			$table->enum('status', array('A','P'))->nullable();
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
		Schema::drop('arquivos');
	}

}
