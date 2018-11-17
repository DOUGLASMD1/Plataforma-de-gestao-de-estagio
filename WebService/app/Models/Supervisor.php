<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 16 Nov 2018 10:51:41 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Supervisor
 * 
 * @property int $idSupervisor
 * @property string $Cargo
 * @property string $Area_Atuacao
 * @property string $empresas_cnpj
 * @property string $users_cpf
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
	public $incrementing = true;
	protected $table = 'supervisores';

	protected $casts = [
		'roles_idrole' => 'int'
	];

	protected $fillable = [
		'Cargo',
		'Area_Atuacao',
		'empresas_cnpj',
		'users_cpf'
	];

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
		return $this->hasMany(\App\Models\Arquivo::class, 'supervisores_idSupervisor');
	}

	public function estagios()
	{
		return $this->hasMany(\App\Models\Estagio::class, 'supervisores_idSupervisor');
	}

	public function vagas()
	{
		return $this->hasMany(\App\Models\Vaga::class, 'supervisores_idSupervisor');
	}
}
