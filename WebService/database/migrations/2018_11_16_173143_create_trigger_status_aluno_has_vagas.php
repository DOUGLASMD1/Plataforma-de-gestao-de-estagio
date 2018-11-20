<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerStatusAlunoHasVagas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::unprepared('CREATE TRIGGER tr_status_aluno_has_vagas BEFORE INSERT ON alunos_has_vagas
         FOR EACH ROW BEGIN
          SET NEW.status = "EA";
         END;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         DB::unprepared('DROP TRIGGER IF EXISTS tr_status_aluno_has_vagas');
    }
}
