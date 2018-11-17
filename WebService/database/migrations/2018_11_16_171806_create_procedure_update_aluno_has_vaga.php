<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureUpdateAlunoHasVaga extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('drop procedure if exists update_alunos_has_vagas ;
        create procedure update_alunos_has_vagas(STATUS ENUM("A", "R"), ALUNO_RGA VARCHAR(20), VAGAID INT)
        begin
        
        UPDATE alunos_has_vagas SET status = STATUS, updated_at = NOW()
        WHERE  alunos_rga = ALUNO_RGA and vagas_idVagas = VAGAID;
        
        END ; ');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('drop procedure if exists update_alunos_has_vagas;');
    }
}
