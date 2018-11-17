<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTelefonesHasEmpresasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telefones_has_empresas', function(Blueprint $table)
		{
			$table->string('telefones_telefone', 15);
			$table->string('empresas_cnpj', 45);
			$table->timestamps();
			$table->softDeletes();
			$table->primary(['telefones_telefone','empresas_cnpj']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('telefones_has_empresas');
	}

}
