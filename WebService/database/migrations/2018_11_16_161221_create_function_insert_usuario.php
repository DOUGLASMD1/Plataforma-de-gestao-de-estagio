<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionInsertUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('drop function if exists insert_Usuario ;
        CREATE FUNCTION insert_Usuario(cpfis varchar(45), rg varchar(45), nome varchar(45),
    email varchar(45), senha longtext, acao_idacao int)
    
    returns varchar(45)
    begin
        declare pessoa_fisica varchar(45);
        insert into users(cpf, rg, name, email, password, remember_token, roles_idrole, created_at, updated_at, deleted_at) 
        values(cpfis, rg, nome, email, senha, remember_token, acao_idacao, NOW(), NOW(), NULL);
        
        select cpf into pessoa_fisica from users where cpf=cpfis;
      
        return pessoa_fisica; 
    end ;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('drop function if exists insert_Usuario;');
    }
}
