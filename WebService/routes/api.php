<?php

use Illuminate\Http\Request;

Route::post('/login', 'Api\UserController@login');

//Route::post('/register-coordenador', 'Api\CoordenadorController@register');

Route::get('/vaga-alunos', 'Api\VagaController@alunos');


Route::middleware('auth:api')->group( function () {
    Route::post('/register-coordenador', 'Api\CoordenadorController@register');
	Route::post('/register-aluno', 'Api\AlunoController@register');
    Route::post('/register-supervisor', 'Api\SupervisorController@register');
    Route::post('/register-vaga', 'Api\VagaController@register');
    Route::get('/vagas-supervisor/{cpf}', 'Api\SupervisorController@vagasSupervisor');
    Route::put('/update-vaga/{idVagas}', 'Api\VagaController@updateVaga');
    Route::put('/update-estagio/{idEstagio}', 'Api\EstagioController@updateEstagio');
    Route::post('/register-frequencia', 'Api\FrequenciaController@register');
    Route::put('/update-estagio/{idEstagio}', 'Api\EstagioController@updateEstagio');  
    Route::put('/update-frequencia/{idFrequencia}', 'Api\FrequenciaController@updateFrequencia');    
    Route::post('/registe-aluno-vaga', 'Api\AlunoController@candidateVagas');    
    Route::post('/update-aluno-vaga', 'Api\SupervisorController@updateAlunoVaga');    
    Route::post('/submit-file', 'Api\ArquivoController@uploadArquivo');
    Route::get('/user', 'Api\UserController@userDetails');
    Route::get('/vagas', 'Api\VagaController@vagas');
});


