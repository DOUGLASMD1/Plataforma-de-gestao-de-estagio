<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFrequenciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('frequencias', function(Blueprint $table)
		{
			$table->foreign('estagio_idestagio')->references('idestagio')->on('estagios')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('frequencias', function(Blueprint $table)
		{
			$table->dropForeign('estagio_idestagio');
		});
	}

}
