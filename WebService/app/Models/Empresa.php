<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 16 Nov 2018 10:50:09 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Empresa
 * 
 * @property string $cnpj
 * @property string $nome
 * @property string $nome_representante
 * @property string $ramo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $enderecos
 * @property \Illuminate\Database\Eloquent\Collection $supervisores
 * @property \Illuminate\Database\Eloquent\Collection $telefones
 *
 * @package App\Models
 */
class Empresa extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $primaryKey = 'cnpj';
	public $incrementing = false;

	protected $fillable = [
		'nome',
		'nome_representante',
		'ramo'
	];

	public function enderecos()
	{
		return $this->belongsToMany(\App\Models\Endereco::class, 'empresas_has_enderecos', 'emp_cnpj', 'enderecos_idendereco')
					->withPivot('deleted_at')
					->withTimestamps();
	}

	public function supervisores()
	{
		return $this->hasMany(\App\Models\Supervisor::class, 'empresas_cnpj');
	}

	public function telefones()
	{
		return $this->belongsToMany(\App\Models\Telefone::class, 'telefones_has_empresas', 'empresas_cnpj', 'telefones_telefone')
					->withPivot('deleted_at')
					->withTimestamps();
	}
}
