<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertAlunoHasTelefone extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('drop procedure if exists insert_aluno_has_telefone ;
        create procedure insert_aluno_has_telefone (rga varchar(25),telefone varchar(15))
        begin
        insert into alunos_has_telefones(alunos_rga,telefones_telefone, created_at, updated_at, deleted_at) 
        values(rga,telefone, NOW(), NOW(), NULL);
        END ; ');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('drop procedure if exists insert_aluno_has_telefone;');
    }
}
