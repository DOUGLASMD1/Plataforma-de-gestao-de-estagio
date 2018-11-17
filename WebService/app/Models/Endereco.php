<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 16 Nov 2018 10:50:19 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Endereco
 * 
 * @property int $idendereco
 * @property string $rua
 * @property string $numero
 * @property string $bairro
 * @property string $cidade
 * @property string $cep
 * @property string $estado
 * @property string $complemento
 * @property string $campus_nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Campus $campus
 * @property \Illuminate\Database\Eloquent\Collection $alunos
 * @property \Illuminate\Database\Eloquent\Collection $empresas
 * @property \Illuminate\Database\Eloquent\Collection $instituicaos
 *
 * @package App\Models
 */
class Endereco extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $primaryKey = 'idendereco';

	protected $fillable = [
		'rua',
		'numero',
		'bairro',
		'cidade',
		'cep',
		'estado',
		'complemento',
		'campus_nome'
	];

	public function campus()
	{
		return $this->belongsTo(\App\Models\Campus::class, 'campus_nome');
	}

	public function alunos()
	{
		return $this->belongsToMany(\App\Models\Aluno::class, 'alunos_has_enderecos', 'enderecos_idendereco', 'alunos_rga')
					->withPivot('deleted_at')
					->withTimestamps();
	}

	public function empresas()
	{
		return $this->belongsToMany(\App\Models\Empresa::class, 'empresas_has_enderecos', 'enderecos_idendereco', 'emp_cnpj')
					->withPivot('deleted_at')
					->withTimestamps();
	}

	public function instituicaos()
	{
		return $this->hasMany(\App\Models\Instituicao::class, 'enderecos_idendereco');
	}
}
