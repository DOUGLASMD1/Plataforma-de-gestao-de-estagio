<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 15 Nov 2018 19:23:16 -0300.
 */

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


/**
 * Class User
 * 
 * @property string $cpf
 * @property string $rg
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property int $roles_idrole
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Role $role
 * @property \Illuminate\Database\Eloquent\Collection $alunos
 * @property \Illuminate\Database\Eloquent\Collection $coordenadores
 * @property \Illuminate\Database\Eloquent\Collection $mensagens
 * @property \Illuminate\Database\Eloquent\Collection $supervisores
 *
 * @package App\Models
 */

class User extends Authenticatable
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	use HasApiTokens, Notifiable;
	
	protected $primaryKey = 'cpf';
	public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

	protected $casts = [
		'roles_idrole' => 'int'
	];

    protected $fillable = [
		'cpf',
		'rg',
		'name',
		'email',
		'password',
		'roles_idrole'
	];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
	];
	
	public function role()
	{
		return $this->belongsTo(\App\Models\Role::class, 'roles_idrole');
	}

	public function aluno()
	{
		return $this->hasOne(\App\Models\Aluno::class, 'users_cpf');
	}

	public function coordenador()
	{
		return $this->hasOne(\App\Models\Coordenador::class, 'users_cpf');
	}

	public function mensagens()
	{
		return $this->hasMany(\App\Models\Mensagem::class, 'users_cpf');
	}

	public function supervisor()
	{
		return $this->hasOne(\App\Models\Supervisor::class, 'users_cpf');
	}

}
