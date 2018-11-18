<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SupervisorController extends Controller
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
}
