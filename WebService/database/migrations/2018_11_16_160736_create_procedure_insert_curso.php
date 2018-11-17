<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertCurso extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS INSERT_CURSOS ;
        
        CREATE PROCEDURE INSERT_CURSOS(COD_CURSO INT, REGULAMENTO TEXT, NOME_CURSO VARCHAR(150), CAMPUS_NOME VARCHAR(45))
        
        begin
        DECLARE CURSO INT;
        
        INSERT INTO cursos(codCurso, nomeCurso, regulamentoEstagio, campus_nome,created_at, updated_at, deleted_at) 
        VALUES(COD_CURSO, NOME_CURSO, REGULAMENTO, CAMPUS_NOME,NOW(), NOW(), NULL);
        
        SELECT codCurso INTO CURSO from cursos where cursos.codCurso = COD_CURSO;
        
        END ;');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS INSERT_CURSOS;');
    }
}
