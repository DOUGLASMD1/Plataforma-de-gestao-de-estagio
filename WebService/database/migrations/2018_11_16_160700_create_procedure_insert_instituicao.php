<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertInstituicao extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS INSERT_INSTITUICAO ;
        
        CREATE PROCEDURE INSERT_INSTITUICAO(CNPJ VARCHAR(45), RAZAO_SOCIAL VARCHAR(45), EMAIL VARCHAR(45), 
        SITE VARCHAR(45), TIPO_ENSINO ENUM("Pub","Pri"), RUA VARCHAR(45), NUMERO VARCHAR(45), BAIRRO VARCHAR(45), CIDADE VARCHAR(45),
        ESTADO VARCHAR(45), CEP VARCHAR(45), TELEFONE VARCHAR(20),COMPLEMENTO VARCHAR(50), CAMPUS_NOME VARCHAR(45))
        
        begin
        DECLARE idendereco INT;
        DECLARE CNPJINS VARCHAR(45);
        DECLARE telefoneaux INT;
        
        set idendereco = (select INSERT_ENDERECO(RUA, NUMERO, BAIRRO, CIDADE,
        ESTADO, CEP, COMPLEMENTO, CAMPUS_NOME));
        
        set telefoneaux = (select Insert_Telefone(TELEFONE));
        
        INSERT INTO instituicao(CNPJ,Razao_Social, email, site, tipoEnsino, enderecos_idendereco, created_at, updated_at, deleted_at) 
        VALUES(CNPJ, RAZAO_SOCIAL, EMAIL, SITE, TIPO_ENSINO, idendereco, NOW(), NOW(), NULL);
        
        select instituicao.CNPJ INTO CNPJINS FROM instituicao where instituicao.CNPJ = CNPJ;
        
        call insert_telefones_has_instituicoes(telefoneaux, CNPJINS);
        
        END ;');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS INSERT_INSTITUICAO;');
    }
}
