<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 16 Nov 2018 10:51:59 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Telefone
 * 
 * @property string $telefone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $alunos
 * @property \Illuminate\Database\Eloquent\Collection $campuses
 * @property \Illuminate\Database\Eloquent\Collection $empresas
 * @property \Illuminate\Database\Eloquent\Collection $telefones_has_instituicos
 *
 * @package App\Models
 */
class Telefone extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $primaryKey = 'telefone';
	public $incrementing = false;

	public function alunos()
	{
		return $this->belongsToMany(\App\Models\Aluno::class, 'alunos_has_telefones', 'telefones_telefone', 'alunos_rga')
					->withPivot('deleted_at')
					->withTimestamps();
	}

	public function campuses()
	{
		return $this->belongsToMany(\App\Models\Campus::class, 'campus_has_telefones', 'telefones_telefone', 'campus_nome')
					->withPivot('deleted_at')
					->withTimestamps();
	}

	public function empresas()
	{
		return $this->belongsToMany(\App\Models\Empresa::class, 'telefones_has_empresas', 'telefones_telefone', 'empresas_cnpj')
					->withPivot('deleted_at')
					->withTimestamps();
	}

	public function telefones_has_instituicos()
	{
		return $this->hasMany(\App\Models\TelefonesHasInstituico::class, 'tel_telefone');
	}
}
