<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionInsertTelefone extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('drop function if exists Insert_Telefone ;
        
        CREATE FUNCTION Insert_Telefone(Telefone_IT VARCHAR(15))
        
        returns varchar(15) 
        begin
        
        DECLARE telaux varchar(15);
        
        insert into telefones(telefone, created_at, updated_at, deleted_at) values(Telefone_IT, NOW(), NOW(), NULL);
        
        select telefones.telefone into telaux from telefones where telefones.telefone = Telefone_IT;
        
        return telaux;
        end; ');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('drop function if exists Insert_Telefone;');
    }
}
