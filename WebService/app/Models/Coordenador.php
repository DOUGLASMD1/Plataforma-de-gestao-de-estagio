<?php

/**
* Created by Reliese Model.
* Date: Fri, 16 Nov 2018 10:49:54 -0300.
*/

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

/**
* Class Coordenador
* 
* @property int $SIAPE
* @property string $Cargo
* @property string $users_cpf
* @property int $cursos_codCurso
* @property \Carbon\Carbon $created_at
* @property \Carbon\Carbon $updated_at
* @property string $deleted_at
* 
* @property \App\Models\Curso $curso
* @property \App\Models\User $user
* @property \Illuminate\Database\Eloquent\Collection $estagios
*
* @package App\Models
*/
class Coordenador extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	public $incrementing = false;
	protected $table = 'coordenadores';
	
	protected $casts = [
		'SIAPE' => 'int',
		'cursos_codCurso' => 'int'
	];
	
	protected $fillable = [
		'SIAPE',
		'Cargo',
		'users_cpf',
		'cursos_codCurso'
	];
	
	public static function InsertCoordenador($data)
	{
		$data['password'] = \Hash::make($data['password']);	
		DB::select('call insert_Coordenadores(?,?,?,?,?,?,?,?,?)',array(
			$data['cpf'],
			$data['rg'],
			$data['nome'],
			$data['email'],
			$data['password'],
			$data['Siape'],
			$data['Cargo'],
			$data['Curso'],
		));
	}
	
	public function curso()
	{
		return $this->belongsTo(\App\Models\Curso::class, 'cursos_codCurso');
	}
	
	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'users_cpf');
	}
	
	public function estagios()
	{
		return $this->hasMany(\App\Models\Estagio::class, 'coordenadores_SIAPE');
	}
}
