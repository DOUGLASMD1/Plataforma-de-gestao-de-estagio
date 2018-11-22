<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 18 Nov 2018 11:09:53 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

/**
 * Class Supervisor
 * 
 * @property string $Cargo
 * @property string $Area_Atuacao
 * @property string $users_cpf
 * @property string $empresas_cnpj
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Empresa $empresa
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $arquivos
 * @property \Illuminate\Database\Eloquent\Collection $estagios
 * @property \Illuminate\Database\Eloquent\Collection $vagas
 *
 * @package App\Models
 */
class Supervisor extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	public $incrementing = false;

	protected $fillable = [
		'Cargo',
		'Area_Atuacao'
	];

	protected $table = 'supervisores';

	public static function InsertSupervisor($data)
	{
		$data['password'] = \Hash::make($data['password']);	
		DB::select('call insert_Supervisor(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',array(
			$data['cargo'],
			$data['areaAtuacao'],
			$data['cpf'],
			$data['rg'],
			$data['nome'],
			$data['email'],
			$data['password'],
			$data['cnpj'],
			$data['nomeEmpresa'],
			$data['nomeRepre'],
			$data['ramo'],
			$data['rua'],
			$data['numero'],
			$data['bairro'],
			$data['cidade'],
			$data['cep'],
			$data['estado'],
			$data['complemento'],
			$data['telefone'],
		));
	}

	public function empresa()
	{
		return $this->belongsTo(\App\Models\Empresa::class, 'empresas_cnpj');
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'users_cpf');
	}

	public function arquivos()
	{
		return $this->hasMany(\App\Models\Arquivo::class, 'supervisor');
	}

	public function estagios()
	{
		return $this->hasMany(\App\Models\Estagio::class, 'supervisor');
	}

	public static function vagas($supervisor)
	{
		$vagas = DB::table('vagas')
            ->join('supervisores', 'supervisores.users_cpf', '=', 'vagas.supervisor')
			->select('vagas.idVagas', 'vagas.Titulo', 'vagas.Area',
			'vagas.Requisitos_para_Vaga','vagas.status','vagas.idVagas','vagas.created_at',
			'vagas.updated_at')
			->where('supervisores.users_cpf', '=', $supervisor)
			->get();
		return $vagas;
	}
}
