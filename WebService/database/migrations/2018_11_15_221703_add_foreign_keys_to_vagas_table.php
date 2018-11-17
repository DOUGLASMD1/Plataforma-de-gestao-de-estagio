<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVagasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('vagas', function(Blueprint $table)
		{
			$table->foreign('supervisor')->references('users_cpf')->on('supervisores')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('vagas', function(Blueprint $table)
		{
			$table->dropForeign('supervisor');
		});
	}

}
