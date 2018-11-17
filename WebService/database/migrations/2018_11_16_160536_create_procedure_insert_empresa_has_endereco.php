<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertEmpresaHasEndereco extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('drop procedure if exists insert_empresas_has_enderecos ;
        create procedure insert_empresas_has_enderecos (EMPRESA_CNPJ VARCHAR(45), IDENDERECO INT)
        begin	
        insert into empresas_has_enderecos(emp_cnpj, enderecos_idendereco, created_at, updated_at, deleted_at) 
        values(EMPRESA_CNPJ, IDENDERECO, NOW(), NOW(), NULL); 
        END ;');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('drop procedure if exists insert_empresas_has_enderecos;');
    }
}
