<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureReprovaAlunoHasVaga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('drop procedure if exists reprova_aluno_has_vagas ;
        create procedure reprova_aluno_has_vagas(IDVAGA INT)
    begin	
         UPDATE alunos_has_vagas SET status = "R", updated_at = NOW()
         WHERE  vagas_idVagas = IDVAGA AND status = "EA";
    END ;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('drop procedure if exists reprova_aluno_has_vagas;');
    }
}
