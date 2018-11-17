<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertFrequencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('drop procedure if exists insert_frequencia ;
        create procedure insert_frequencia(DATA_INICIO DATETIME, DATA_FIM DATETIME, DESCRICAO_ALUNO TEXT, IDESTAGIO INT)
    begin	
         insert into frequencias(Data_inicio, data_fim, Descricao_aluno, Descricao_Supervisor, status, estagio_idestagio, 
             created_at, updated_at, deleted_at) 
             values(DATA_INICIO,DATA_FIM, DESCRICAO_ALUNO, NULL, NULL, IDESTAGIO, NOW(), NOW(), NULL);
    END ;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('drop procedure if exists insert_frequencia;');
    }
}
