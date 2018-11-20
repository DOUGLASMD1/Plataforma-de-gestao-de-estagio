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
			$table->integer('telefones_telefone');
			$table->string('empresas_cnpj',15);
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
		Schema::dropIfExists('telefones_has_empresas');
	}

}
