<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertSupervisor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('drop procedure if exists insert_Supervisor ;

        CREATE PROCEDURE insert_Supervisor(cargo varchar(45),  areaAtuacao varchar(45), /* Supervisor */
        cpfis varchar(45), rg varchar(45), nome varchar(45),email varchar(45), senha varchar(45), acao_idacao varchar(45),  /* Usuário */
        cnpj varchar(45), nomeEmpresa varchar(45), nome_repre varchar(45), ramo varchar(45),
        rua varchar(45),numero varchar(45), bairro varchar(45), cidade varchar(25),cep varchar(45), 
        estado varchar(45), complemento varchar(45), telefone varchar(45)) /* Empresa */
        
        begin
            declare people varchar(45);
            declare company varchar(45);
        
            set people = (select insert_Usuario(cpfis, rg, nome, email, senha, acao_idacao));
            set company = (select insert_Empresa(cnpj, nomeEmpresa, nome_repre, ramo,rua,numero, bairro, 
                cidade,cep, estado, complemento, telefone));
            
        
            insert into supervisores(Cargo, Area_Atuacao, empresas_cnpj, users_cpf, created_at, updated_at, deleted_at) 
                values(cargo, areaAtuacao, company, people,NOW(), NOW(), NULL);
        
        end;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('drop procedure if exists insert_Supervisor;');
    }
}
