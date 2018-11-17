<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCampusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('campus', function(Blueprint $table)
		{
			$table->foreign('instituicao_CNPJ')->references('CNPJ')->on('instituicao')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('campus', function(Blueprint $table)
		{
			$table->dropForeign('instituicao_CNPJ');
		});
	}

}
