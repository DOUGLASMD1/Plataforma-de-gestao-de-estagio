<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertCoordenador extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS insert_Coordenadores ;
        CREATE PROCEDURE insert_Coordenadores(cpf varchar(45), rg varchar(45), nome varchar(45), email varchar(45), 
        senha varchar(45), id_acao int, intSIAPE_Coo INT,  Cargo_Coo VARCHAR(45),
        cursos_codCurso INT)
        
        BEGIN
        
        set @usuario = (select insert_Usuario(cpf,rg,nome,email,senha,id_acao));
        
        insert into coordenadores(SIAPE, Cargo, users_cpf, cursos_codCurso, created_at, updated_at, deleted_at) 
        values(intSIAPE_Coo, Cargo_Coo, @usuario, cursos_codCurso, NOW(), NOW(), NULL);
        
        END ;');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS insert_Coordenadores;');
    }
}
