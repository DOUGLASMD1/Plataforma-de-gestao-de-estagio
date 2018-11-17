<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTelefonesHasInstituicoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telefones_has_instituicoes', function(Blueprint $table)
		{
			$table->string('tel_telefone', 15);
			$table->string('instituicao_CNPJ', 45);
			$table->timestamps();
			$table->softDeletes();
			$table->primary(['tel_telefone','instituicao_CNPJ']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('telefones_has_instituicoes');
	}

}
