<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertVaga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS insert_vagas ;
        create FUNCTION insert_vagas(TITULO VARCHAR(100), AREA VARCHAR(100), REQUISITOS TEXT, SUPERVISOR VARCHAR(45))
        RETURNS INT
        begin 
        DECLARE IDVAGA INT;    
         insert into vagas(Titulo, Area, requisitos_para_vaga, supervisor, created_at, updated_at, deleted_at) 
             values(TITULO,AREA, REQUISITOS, SUPERVISOR, NOW(), NOW(), NULL);

             SELECT MAX(idVagas) INTO IDVAGA FROM vagas;

             RETURN IDVAGA;
    END ;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS insert_vagas;');
    }
}
