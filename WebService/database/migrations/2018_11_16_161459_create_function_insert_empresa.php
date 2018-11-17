<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionInsertEmpresa extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('drop function if exists insert_Empresa;
        CREATE FUNCTION insert_Empresa(cnpjEmpresa varchar(45), nome varchar(45), nome_repre varchar(45), ramo varchar(45),
        rua varchar(45),numero varchar(45), bairro varchar(45), cidade varchar(25),cep varchar(45), 
        estado varchar(45), complemento varchar(45), telefone varchar(45))
        returns varchar(45) 
        
        begin
        declare cnpjaux varchar(45);
        insert into empresas(cnpj, nome, nome_representante, ramo, created_at, updated_at, deleted_at) 
        values(cnpjEmpresa, nome, nome_repre, ramo, NOW(), NOW(), NULL); 
        select empresas.cnpj into cnpjaux from empresas where empresas.cnpj = cnpj;
        
        set @idendereco = (select INSERT_ENDERECO(rua,numero,bairro,cidade,cep,estado,complemento,NULL));
        set @telefone = (select Insert_Telefone(telefone));
        
        call insert_empresas_has_enderecos(cnpjaux, @idendereco);
        call insert_telefone_has_empresa(@telefone, cnpjaux);
        
        return cnpjaux;
        end ;');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('drop function if exists insert_Empresa;');
    }
}
