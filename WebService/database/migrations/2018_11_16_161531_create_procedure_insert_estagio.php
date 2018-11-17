<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertEstagio extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('drop procedure if exists insert_estagio ;
        create procedure insert_estagio(ALUNO_RGA varchar(20), COORDENADOR INT)
        begin	
        insert into estagios(data_inicio, data_fim, alunos_rga, supervisor,coordenadores_SIAPE, created_at, updated_at, deleted_at) 
        values(NULL,NULL, ALUNO_RGA, NULL, COORDENADOR, NOW(), NOW(), NULL);
        END ;');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('drop procedure if exists insert_estagio;');
    }
}
