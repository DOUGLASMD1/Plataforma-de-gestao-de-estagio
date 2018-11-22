<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Supervisor;
use App\Models\AlunosHasVaga;
use App\Models\Vaga;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Api\BaseController;

class SupervisorController extends BaseController
{
    public function register(Request $request)
    {
        $data = $request->all();
        
        $validacao = Validator::make($data, [
            'nome' => 'required|string|max:255',
            //'cpf' => 'required|cpf',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            ]);
            
            if($validacao->fails())
            {
                return $validacao->errors();
            }
            
            Supervisor::InsertSupervisor($data);
            $user = User::where('email' , $data['email'])->first(); 
            $user->token = $user->createToken($user->email)->accessToken;
            return $user;
    }

    public function vagasSupervisor($cpf){
        $supervisor = Supervisor::vagas($cpf);
        return $this->sendResponse($supervisor->toArray(), 'Vagas recuperadas com sucesso.');
    }

    public function updateAlunoVaga(Request $request){
        $data = $request->all();
        AlunosHasVaga::updateAlunoVaga($data);
        return $this->sendResponse('', 'Status do aluno atualizado com sucesso.');    
    }
}