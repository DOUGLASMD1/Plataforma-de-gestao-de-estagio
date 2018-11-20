<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupervisoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('supervisores', function(Blueprint $table)
		{
			$table->string('Cargo', 45);
			$table->string('Area_Atuacao', 45);
			$table->string('users_cpf', 45);
			$table->string('empresas_cnpj', 45);
			$table->timestamps();
			$table->softDeletes();
			$table->primary(['users_cpf','empresas_cnpj']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('supervisores');
	}

}
