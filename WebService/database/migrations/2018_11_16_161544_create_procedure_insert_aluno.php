<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInsertAluno extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        DB::unprepared('drop PROCEDURE if exists insert_aluno ;
        CREATE PROCEDURE insert_aluno(RGAALUNO varchar(25), sem_atual varchar(25),cursos_codCurso INT, cpf varchar(45), 
        rg varchar(45), nome varchar(45), email varchar(45), senha longtext, 
        rua varchar(45),numero varchar(45), bairro varchar(45), cidade varchar(25),cep varchar(45), 
        estado varchar(45), complemento varchar(45), telefoneAluno varchar(15))
        
        begin
        DECLARE ID_ROLE INT; 
        DECLARE cpfaux INT;
        DECLARE RGA VARCHAR(20);
        DECLARE COORDENADOR INT;

        select idrole INTO ID_ROLE from roles where roles.nome = "Aluno";
        set @usuario = (select insert_Usuario(cpf,rg,nome,email,senha,ID_ROLE));   

        insert into alunos(rga, semestreAtual, users_cpf, cursos_codCurso, created_at, updated_at, deleted_at) 
        values(RGAALUNO,sem_atual,@usuario,cursos_codCurso, NOW(), NOW(), NULL); 
        select alunos.rga INTO RGA FROM alunos where alunos.rga = RGAALUNO;
        
        set @idendereco = (select INSERT_ENDERECO(rua,numero,bairro,cidade,cep,estado,complemento,NULL));
        set @telefone = (select Insert_Telefone(telefoneAluno));
        
        set COORDENADOR = (select select_coordenador_curso(cursos_codCurso));
        call insert_aluno_has_endereco (RGA, @idendereco);
        call insert_aluno_has_telefone (RGA, @telefone);
        call insert_estagio(RGA, COORDENADOR);
        
        end ; ');
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::unprepared('drop PROCEDURE if exists insert_aluno;');
    }
}
