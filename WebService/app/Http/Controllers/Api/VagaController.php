<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vaga;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;


class VagaController extends BaseController
{
    public function __construct(Vaga $vaga){
        $this->vaga = $vaga;   
    }
    
    public function register(Request $request)
    {
        $data = $request->all();
        $validacao = Validator::make($data, [
            'Titulo' => 'required|string|max:100',
            'Area' => 'required|string|max:100',
            'Requisitos_para_Vaga' => 'required|string',
            ]);
            
            
        if($validacao->fails()){
            return $this->sendError('Erro de validação.', $validacao->errors());       
        }
            
        $vaga = $this->vaga->registerVaga($data);
        return $this->sendResponse($vaga->toArray(), 'Vaga criada com sucesso.');
            
            
    }

    public function updateVaga(Request $request, $idVagas)
    {
        $data = $request->all();
        $validacao = Validator::make($data, [
            'Titulo' => 'required|string|max:100',
            'Area' => 'required|string|max:100',
            'Requisitos_para_Vaga' => 'required|string',
            'status' => 'required|string',
            ]);   
            
        if($validacao->fails()){
            return $this->sendError('Erro de validação.', $validacao->errors());       
        }    
        $vaga = $this->vaga->updateVaga($data, $idVagas);
        if(!$vaga)
        {
            return $this->sendError('Vaga não encontrada.', $validacao->errors());
        }
        return $this->sendResponse($vaga->toArray(), 'Vaga atualizada com sucesso.');
    }

    public function vagas(){
        $vagas = Vaga::vagas();
        return $this->sendResponse($vagas->toArray(), 'Vagas recuperadas com sucesso.');
    }
}
    