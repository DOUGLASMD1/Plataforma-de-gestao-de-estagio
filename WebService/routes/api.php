<?php

use Illuminate\Http\Request;

Route::post('/login', 'Api\UserController@login');

//Route::post('/register-coordenador', 'Api\CoordenadorController@register');

Route::middleware('auth:api')->group( function () {
    Route::post('/register-coordenador', 'Api\CoordenadorController@register');
	Route::post('/register-aluno', 'Api\AlunoController@register');
    Route::post('/register-supervisor', 'Api\SupervisorController@register');

    Route::post('/register-vaga', 'Api\SupervisorController@register');
    Route::put('/update-vaga', 'Api\SupervisorController@register');
    Route::put('/update-estagio', 'Api\SupervisorController@register');
    Route::put('/update-status-vaga', 'Api\SupervisorController@register');
    Route::post('/register-frequencia', 'Api\SupervisorController@register');
    Route::put('/update-frequencia', 'Api\SupervisorController@register');
    Route::post('/registe-aluno-vaga', 'Api\SupervisorController@register');
    Route::put('/update-aluno-vaga', 'Api\SupervisorController@register');
    Route::post('/submit-file', 'Api\SupervisorController@register');
    
    Route::get('/user', 'Api\UserController@userDetails');
});


