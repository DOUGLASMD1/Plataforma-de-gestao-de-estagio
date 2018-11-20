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
			$table->string('filename');
            $table->string('tipo');
            $table->string('path');
            $table->integer('size');
			$table->integer('coor_siape')->nullable();
			$table->string('aluno_rga',20)->nullable();
			$table->string('super_users_cpf',45)->nullable();
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
		Schema::dropIfExists('arquivos');
	}

}
