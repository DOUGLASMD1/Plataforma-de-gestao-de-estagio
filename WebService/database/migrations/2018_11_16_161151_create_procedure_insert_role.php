<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertRole extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('drop procedure if exists insert_roles ;
        create procedure insert_roles(NOME VARCHAR(100))
        begin   
        insert into roles(nome, created_at, updated_at, deleted_at) 
        values(NOME, NOW(), NOW(), NULL);
        END ;');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('drop procedure if exists insert_roles;');
    }
}
