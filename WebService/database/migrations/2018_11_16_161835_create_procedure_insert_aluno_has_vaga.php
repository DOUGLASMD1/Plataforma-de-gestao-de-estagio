<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertAlunoHasVaga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('drop procedure if exists insert_aluno_has_vagas ;
        create procedure insert_aluno_has_vagas (ALUNO_RGA varchar(20), IDVAGA INT)
    begin
         insert into alunos_has_vagas(alunos_rga, vagas_idVagas, created_at, updated_at, deleted_at) 
             values(ALUNO_RGA, IDVAGA, NOW(), NOW(), NULL);

             UPDATE estagios SET status = "PS", updated_at = NOW()
             WHERE  alunos_rga = ALUNO_RGA;
    END ; ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('drop procedure if exists insert_aluno_has_vagas;');
    }
}
