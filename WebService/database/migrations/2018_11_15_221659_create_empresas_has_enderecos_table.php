<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpresasHasEnderecosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresas_has_enderecos', function(Blueprint $table)
		{
			$table->string('emp_cnpj', 45);
			$table->integer('enderecos_idendereco');
			$table->timestamps();
			$table->softDeletes();
			$table->primary(['emp_cnpj','enderecos_idendereco']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('empresas_has_enderecos');
	}

}
