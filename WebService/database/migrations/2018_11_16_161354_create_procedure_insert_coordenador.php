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
        senha longtext, intSIAPE_Coo INT,  Cargo_Coo VARCHAR(45),
        cursos_codCurso INT)
        
        BEGIN
        DECLARE ID_ROLE INT;
        select idrole INTO ID_ROLE from roles where roles.nome = "Coordenador";
        set @usuario = (select insert_Usuario(cpf,rg,nome,email,senha,ID_ROLE)); 
        
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
