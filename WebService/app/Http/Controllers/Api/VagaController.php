<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vaga;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;


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
}
    