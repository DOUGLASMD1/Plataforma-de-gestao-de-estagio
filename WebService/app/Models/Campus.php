<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 16 Nov 2018 10:49:41 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Campus
 * 
 * @property string $nome
 * @property string $diretor
 * @property string $emailDirecao
 * @property string $site
 * @property string $instituicao_CNPJ
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Instituicao $instituicao
 * @property \Illuminate\Database\Eloquent\Collection $telefones
 * @property \Illuminate\Database\Eloquent\Collection $cursos
 * @property \Illuminate\Database\Eloquent\Collection $enderecos
 *
 * @package App\Models
 */
class Campus extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'campus';
	protected $primaryKey = 'nome';
	public $incrementing = false;

	protected $fillable = [
		'diretor',
		'emailDirecao',
		'site',
		'instituicao_CNPJ'
	];

	public function instituicao()
	{
		return $this->belongsTo(\App\Models\Instituicao::class, 'instituicao_CNPJ');
	}

	public function telefones()
	{
		return $this->belongsToMany(\App\Models\Telefone::class, 'campus_has_telefones', 'campus_nome', 'telefones_telefone')
					->withPivot('deleted_at')
					->withTimestamps();
	}

	public function cursos()
	{
		return $this->hasMany(\App\Models\Curso::class, 'campus_nome');
	}

	public function enderecos()
	{
		return $this->hasMany(\App\Models\Endereco::class, 'campus_nome');
	}
}
