<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureUpdateVaga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('drop procedure if exists update_vagas ;
        create procedure update_vagas(TITULO VARCHAR(100), AREA VARCHAR(100), REQUISITOS TEXT, STATUS ENUM("A", "E"), IDVAGA INT)
    begin
        UPDATE vagas SET Titulo = TITULO, Area = AREA, Requisitos_para_vaga = REQUISITOS, status = STATUS, updated_at = NOW()
        WHERE  idVagas = IDVAGA;

        IF STATUS = "E" THEN
		    call reprova_aluno_has_vagas(IDVAGA);
	    END IF;
    END ;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('drop procedure if exists update_vagas;');
    }
}
