<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 16 Nov 2018 10:48:02 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Aluno
 * 
 * @property string $rga
 * @property string $semestreAtual
 * @property string $users_cpf
 * @property int $cursos_codCurso
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Curso $curso
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $enderecos
 * @property \Illuminate\Database\Eloquent\Collection $telefones
 * @property \Illuminate\Database\Eloquent\Collection $vagas
 * @property \Illuminate\Database\Eloquent\Collection $arquivos
 * @property \Illuminate\Database\Eloquent\Collection $estagios
 *
 * @package App\Models
 */
class Aluno extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	public $incrementing = false;

	protected $casts = [
		'cursos_codCurso' => 'int'
	];

	protected $fillable = [
		'rga',
		'semestreAtual',
		'users_cpf',
		'cursos_codCurso'
	];

	public function curso()
	{
		return $this->belongsTo(\App\Models\Curso::class, 'cursos_codCurso');
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'users_cpf');
	}

	public function enderecos()
	{
		return $this->belongsToMany(\App\Models\Endereco::class, 'alunos_has_enderecos', 'alunos_rga', 'enderecos_idendereco')
					->withPivot('deleted_at')
					->withTimestamps();
	}

	public function telefones()
	{
		return $this->belongsToMany(\App\Models\Telefone::class, 'alunos_has_telefones', 'alunos_rga', 'telefones_telefone')
					->withPivot('deleted_at')
					->withTimestamps();
	}

	public function vagas()
	{
		return $this->belongsToMany(\App\Models\Vaga::class, 'alunos_has_vagas', 'alunos_rga', 'vagas_idVagas')
					->withPivot('status', 'deleted_at')
					->withTimestamps();
	}

	public function arquivos()
	{
		return $this->hasMany(\App\Models\Arquivo::class, 'alunos_rga');
	}

	public function estagio()
	{
		return $this->hasOne(\App\Models\Estagio::class, 'alunos_rga');
	}
}
