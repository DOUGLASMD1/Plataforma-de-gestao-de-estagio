<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\Estagio;

class EstagioController extends BaseController
{
    public function __construct(Estagio $estagio){
        $this->estagio = $estagio;   
    }

    public function updateEstagio(Request $request, $idEstagio)
    {
        $data = $request->all();
        $validacao = Validator::make($data, [
            'data_inicio' => 'required|string|max:100',
            'data_fim' => 'required|string|max:100',
            'status' => 'required|string',
            'supervisor' => 'required',
            ]);   
            
        if($validacao->fails()){
            return $this->sendError('Erro de validação.', $validacao->errors());       
        }    
        $estagio = $this->estagio->updateEstagio($data, $idEstagio);
        if(!$estagio)
        {
            return $this->sendError('Estagio não encontrado.', $validacao->errors());
        }
        return $this->sendResponse($estagio->toArray(), 'Estagio atualizado com sucesso.');
    }
}
