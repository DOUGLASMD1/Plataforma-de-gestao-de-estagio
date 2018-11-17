<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureUpdateEstagio extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('drop procedure if exists update_estagio ;
        create procedure update_estagio(DATA_INICIO DATETIME, DATA_FIM DATETIME, STATUS ENUM("A", "CA", "CR"), ALUNO_RGA varchar(20), SUPERVISOR INT)
        begin
        
        UPDATE estagios SET data_inicio = DATA_INICIO, data_fim = DATA_FIM, status = STATUS, supervisores_idSupervisor = SUPERVISOR, 
        updated_at = NOW()
        WHERE alunos_rga = ALUNO_RGA;
        
        END ;');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('drop procedure if exists update_estagio;');
    }
}
