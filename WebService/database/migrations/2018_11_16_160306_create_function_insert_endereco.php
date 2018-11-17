<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionInsertEndereco extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS INSERT_ENDERECO ;
        CREATE FUNCTION INSERT_ENDERECO(RUA VARCHAR(100), NUMERO VARCHAR(45), BAIRRO VARCHAR(100), CIDADE VARCHAR(45),
        ESTADO VARCHAR(45), CEP VARCHAR(45), COMPLEMENTO VARCHAR(100), CAMPUS_NOME VARCHAR(45))
        
        RETURNS INT
        begin
        DECLARE enderecoaux INT;
        INSERT INTO enderecos(rua,numero,bairro,cidade,cep,estado,complemento,campus_nome, created_at, updated_at, deleted_at) 
        VALUES(RUA, NUMERO, BAIRRO, CIDADE, CEP, ESTADO, COMPLEMENTO,CAMPUS_NOME, NOW(), NOW(), NULL);
        
        SELECT MAX(idendereco) INTO enderecoaux FROM enderecos;
        RETURN enderecoaux;
        END ;');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS INSERT_ENDERECO;');
    }
}
