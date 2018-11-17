<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnderecosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enderecos', function(Blueprint $table)
		{
			$table->integer('idendereco', true);
			$table->string('rua', 100);
			$table->string('numero', 45);
			$table->string('bairro', 100);
			$table->string('cidade', 45);
			$table->string('cep', 45)->nullable();
			$table->string('estado', 45);
			$table->string('complemento', 100)->nullable();
			$table->string('campus_nome', 45)->nullable();
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
		Schema::drop('enderecos');
	}

}
