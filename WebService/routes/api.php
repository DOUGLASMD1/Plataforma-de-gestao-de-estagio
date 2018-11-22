<?php

use Illuminate\Http\Request;

Route::post('/login', 'Api\UserController@login');

Route::post('/register-coordenador', 'Api\CoordenadorController@register');

Route::middleware('auth:api')->group( function () {
    //Route::post('/register-coordenador', 'Api\CoordenadorController@register');
	Route::post('/register-aluno', 'Api\AlunoController@register');
    Route::post('/register-supervisor', 'Api\SupervisorController@register');
    Route::post('/register-frequencia', 'Api\FrequenciaController@register');
    Route::post('/registe-aluno-vaga', 'Api\AlunoController@candidateVagas');
    Route::post('/register-vaga', 'Api\VagaController@register');
    Route::post('/submit-file', 'Api\ArquivoController@uploadArquivo');
    
    Route::put('/update-vaga/{idVagas}', 'Api\VagaController@updateVaga');
    Route::put('/update-estagio/{idEstagio}', 'Api\EstagioController@updateEstagio');    
    Route::put('/update-frequencia/{idFrequencia}', 'Api\FrequenciaController@updateFrequencia');        
    Route::post('/update-aluno-vaga', 'Api\SupervisorController@updateAlunoVaga');    

    Route::get('/user', 'Api\UserController@userDetails');
    Route::get('/vagas', 'Api\VagaController@vagas');
    Route::get('/vaga-alunos', 'Api\VagaController@alunos');
    Route::get('/vagas-supervisor/{cpf}', 'Api\SupervisorController@vagasSupervisor');
    Route::get('/campus-cursos/{campusnome}', 'Api\CursoController@cursos');
});


