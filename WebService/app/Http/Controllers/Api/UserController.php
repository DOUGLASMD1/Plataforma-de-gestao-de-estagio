<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();
        
        $validacao = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            ]);
            
        if($validacao->fails())
        {
            return $validacao->errors();
        }
            
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')]))
        {
            $user = Auth()->user();
            $user->token = $user->createToken($user->email)->accessToken;
            return $user;
        }else
        {
            return response()->json(['error' => 'email ou senha incorretos'], 401);
        }
    }

    public function userDetails(Request $request){
        return $request->user();
    }
}
    