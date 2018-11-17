<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureUpdateFrequencia extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('drop procedure if exists update_frequencia ;
        create procedure update_frequencia(IDFREQUENCIA INT, DESCRICAO_SUPERVISOR TEXT, STATUS ENUM("A"))
        begin
        
        UPDATE frequencias SET Descricao_Supervisor = DESCRICAO_SUPERVISOR, status = STATUS, updated_at = NOW()
        WHERE  frequencias.idFrequencia = IDFREQUENCIA;
        
        END ; ');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('drop procedure if exists update_frequencia;');
    }
}
