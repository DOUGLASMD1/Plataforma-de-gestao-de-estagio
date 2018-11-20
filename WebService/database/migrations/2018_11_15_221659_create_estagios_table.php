<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstagiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estagios', function(Blueprint $table)
		{
			$table->integer('idestagio', true);
			$table->dateTime('data_inicio')->nullable();
			$table->dateTime('data_fim')->nullable();
			$table->enum('status', array('N','PS','A','CA','CR'));
			$table->string('alunos_rga', 20);
			$table->string('supervisor',45)->nullable();
			$table->integer('coordenadores_SIAPE');
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
		Schema::dropIfExists('estagios');
	}

}
