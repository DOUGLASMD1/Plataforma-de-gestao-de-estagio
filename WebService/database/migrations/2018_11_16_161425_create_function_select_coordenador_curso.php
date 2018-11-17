<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionSelectCoordenadorCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS select_coordenador_curso ;
        CREATE FUNCTION select_coordenador_curso(CURSOID INT)
    
    RETURNS INT
    begin
        DECLARE COORDENADORID INT;
       
        SELECT SIAPE INTO COORDENADORID FROM coordenadores INNER JOIN cursos on codCurso = cursos_codCurso;
        RETURN COORDENADORID;
    END ;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS select_coordenador_curso;');
    }
}
