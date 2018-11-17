<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInstituicaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('instituicao', function(Blueprint $table)
		{
			$table->foreign('enderecos_idendereco')->references('idendereco')->on('enderecos')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('instituicao', function(Blueprint $table)
		{
			$table->dropForeign('enderecos_idendereco');
		});
	}

}
