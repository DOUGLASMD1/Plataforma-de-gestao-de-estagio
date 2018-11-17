<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertTelefoneHasInstituicao extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('drop procedure if exists insert_telefones_has_instituicoes ;
        CREATE PROCEDURE insert_telefones_has_instituicoes(Tel_TI VARCHAR(15), InstCNPJ_TI VARCHAR(45))
    begin
        insert into telefones_has_instituicoes(tel_telefone, instituicao_CNPJ, created_at, updated_at, deleted_at) 
            values(Tel_TI, InstCNPJ_TI,NOW(), NOW(), NULL);  
    end ; ');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('drop procedure if exists insert_telefones_has_instituicoes;');
    }
}
