<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertCampus extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS INSERT_CAMPUS ;
        
        CREATE PROCEDURE INSERT_CAMPUS(NOME VARCHAR(45), DIRETOR VARCHAR(45), EMAILDIRECAO VARCHAR(45), SITE VARCHAR(45), INSTITUICAO VARCHAR(45),
        RUA VARCHAR(45), NUMERO VARCHAR(45), BAIRRO VARCHAR(45), CIDADE VARCHAR(45), ESTADO VARCHAR(45), CEP VARCHAR(45), TELEFONE VARCHAR(15), 
        COMPLEMENTO VARCHAR(45))
        
        begin
        DECLARE CAMPUS VARCHAR(45);
        DECLARE telefoneaux INT;
        DECLARE endaux INT;
        
        INSERT INTO campus(nome, diretor, emaildirecao, site, instituicao_CNPJ,created_at, updated_at, deleted_at) 
        VALUES(NOME, DIRETOR, EMAILDIRECAO, SITE, INSTITUICAO,NOW(), NOW(), NULL);
        
        SELECT campus.nome INTO CAMPUS from campus where campus.nome = NOME;
        
        set endaux = (select INSERT_ENDERECO(RUA, NUMERO, BAIRRO, CIDADE, ESTADO, CEP,COMPLEMENTO, CAMPUS));
        
        set telefoneaux = (select Insert_Telefone(TELEFONE));
        
        call insert_campus_has_telefones(CAMPUS, telefoneaux);
        
        
        END ;');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS INSERT_CAMPUS;');
    }
}
