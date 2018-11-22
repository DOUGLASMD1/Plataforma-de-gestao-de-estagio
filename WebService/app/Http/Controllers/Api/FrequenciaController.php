<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Frequencia;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;

class FrequenciaController extends BaseController
{
    public function __construct(Frequencia $freq){
        $this->freq = $freq;   
    }
    
    public function register(Request $request)
    {
        $data = $request->all();
        $validacao = Validator::make($data, [
            'Data_inicio' => 'required|string|max:100',
            'data_fim' => 'required|string|max:100',
            'Descricao_aluno' => 'required|string',
            'estagio_idestagio' => 'required',
            ]);
            
            
        if($validacao->fails()){
            return $this->sendError('Erro de validação.', $validacao->errors());       
        }
            
        $freq = $this->freq->registerFrequencia($data);
        return $this->sendResponse($freq->toArray(), 'Frequencia registrada com sucesso.');
            
            
    }

    public function updateFrequencia(Request $request, $idFrequencia)
    {
        $data = $request->all();
        $validacao = Validator::make($data, [
            'idFrequencia' => 'required',
            'Descricao_Supervisor' => 'required|string',
            'status' => 'required|string',
            ]);   
            
        if($validacao->fails()){
            return $this->sendError('Erro de validação.', $validacao->errors());       
        }

        $freq = $this->freq->updateFrequencia($data, $idFrequencia);
        if(!$freq)
        {
            return $this->sendError('Frequencia não encontrada.', $validacao->errors());
        }
        return $this->sendResponse($freq->toArray(), 'Frequencia atualizada com sucesso.');
    }
}
