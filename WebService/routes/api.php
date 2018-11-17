<?php

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/cadastro', function (Request $request) {
    $data = $request->all();

    DB::select('select insert_Usuario(?,?,?,?,?,?)',array(
        $data['cpf'],
        $data['rg'],
        $data['name'],
        $data['email'],
        $data['password'],
        $data['role']
    ));
    
    
    $user = User::where('cpf' , $data['cpf'])->first();

    //$strFromArr = (object) $user;

/*
    $user = User::create([
        'cpf' => $data['cpf'],
        'rg' => $data['rg'],
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'roles_idrole' => $data['role'],
    ]);
    */

   $user->token = $user->createToken($user->email)->accessToken;

    return $user;
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
