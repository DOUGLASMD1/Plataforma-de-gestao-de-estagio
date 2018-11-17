<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertTelefoneHasEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('drop procedure if exists insert_telefone_has_empresa ;
        create procedure insert_telefone_has_empresa (telefone varchar(15),cnpj varchar(45))
    begin
         insert into telefones_has_empresas(telefones_telefone,empresas_cnpj, created_at, updated_at, deleted_at) 
             values(telefone,cnpj,NOW(), NOW(), NULL);
    END ;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('drop procedure if exists insert_telefone_has_empresa;');
    }
}
