<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCampusHasTelefonesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campus_has_telefones', function(Blueprint $table)
		{
			$table->string('campus_nome', 45);
			$table->string('telefones_telefone', 15);
			$table->timestamps();
			$table->softDeletes();
			$table->primary(['campus_nome','telefones_telefone']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('campus_has_telefones');
	}

}
