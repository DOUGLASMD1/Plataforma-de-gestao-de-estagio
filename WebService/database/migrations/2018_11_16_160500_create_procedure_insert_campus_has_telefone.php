<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertCampusHasTelefone extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS insert_campus_has_telefones ;
        create procedure insert_campus_has_telefones(CAMPUS VARCHAR(45), TELEFONE VARCHAR(15))
        begin     
        insert into campus_has_telefones(campus_nome, telefones_telefone, created_at, updated_at, deleted_at) 
        values(CAMPUS,TELEFONE, NOW(), NOW(), NULL);
        END ;');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS insert_campus_has_telefones;');
    }
}
