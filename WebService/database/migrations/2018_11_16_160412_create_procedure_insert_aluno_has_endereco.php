<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertAlunoHasEndereco extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('drop procedure if exists insert_aluno_has_endereco ;
        create procedure insert_aluno_has_endereco (rga varchar(20),id_endereco int)
        begin	
        insert into alunos_has_enderecos(alunos_rga,enderecos_idendereco, created_at, updated_at, deleted_at) 
        values(rga,id_endereco,NOW(), NOW(), NULL);
        END ;');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('drop procedure if exists insert_aluno_has_endereco;');
    }
}
