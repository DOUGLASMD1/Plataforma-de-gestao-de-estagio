<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTelefonesHasInstituicoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('telefones_has_instituicoes', function(Blueprint $table)
		{
			$table->foreign('instituicao_CNPJ')->references('CNPJ')->on('instituicao')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('tel_telefone')->references('telefone')->on('telefones')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('telefones_has_instituicoes', function(Blueprint $table)
		{
			$table->dropForeign('instituicao_CNPJ');
			$table->dropForeign('tel_telefone');
		});
	}

}
