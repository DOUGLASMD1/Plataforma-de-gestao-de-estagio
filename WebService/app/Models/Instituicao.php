<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 16 Nov 2018 10:50:52 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Instituicao
 * 
 * @property string $CNPJ
 * @property string $Razao_Social
 * @property string $email
 * @property string $site
 * @property string $tipoEnsino
 * @property int $enderecos_idendereco
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Endereco $endereco
 * @property \Illuminate\Database\Eloquent\Collection $campuses
 * @property \Illuminate\Database\Eloquent\Collection $telefones_has_instituicos
 *
 * @package App\Models
 */
class Instituicao extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'instituicao';
	public $incrementing = false;

	protected $casts = [
		'enderecos_idendereco' => 'int'
	];

	protected $fillable = [
		'Razao_Social',
		'email',
		'site',
		'tipoEnsino'
	];

	public function endereco()
	{
		return $this->belongsTo(\App\Models\Endereco::class, 'enderecos_idendereco');
	}

	public function campuses()
	{
		return $this->hasMany(\App\Models\Campus::class, 'instituicao_CNPJ');
	}

	public function telefones_has_instituicos()
	{
		return $this->hasMany(\App\Models\TelefonesHasInstituico::class, 'instituicao_CNPJ');
	}
}
