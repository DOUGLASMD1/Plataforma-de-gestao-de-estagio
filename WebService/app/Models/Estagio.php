<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 21 Nov 2018 13:19:17 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Estagio
 * 
 * @property int $idestagio
 * @property \Carbon\Carbon $data_inicio
 * @property \Carbon\Carbon $data_fim
 * @property string $status
 * @property string $alunos_rga
 * @property string $supervisor
 * @property int $coordenadores_SIAPE
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Aluno $aluno
 * @property \App\Models\Coordenadore $coordenadore
 * @property \App\Models\Supervisore $supervisore
 * @property \Illuminate\Database\Eloquent\Collection $frequencias
 *
 * @package App\Models
 */
class Estagio extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $primaryKey = 'idestagio';

	protected $casts = [
		'coordenadores_SIAPE' => 'int'
	];

	protected $dates = [
		'data_inicio',
		'data_fim'
	];

	protected $fillable = [
		'data_inicio',
		'data_fim',
		'status',
		'alunos_rga',
		'supervisor',
		'coordenadores_SIAPE'
	];

	public static function updateEstagio($data, $idEstagio)
	{
		$estagio = self::find($idEstagio);
		if(is_null($estagio))
		{
			return false;
		}
		$estagio->fill($data);
		$estagio->save();
		return $estagio;
	}

	public function aluno()
	{
		return $this->belongsTo(\App\Models\Aluno::class, 'alunos_rga');
	}

	public function coordenadore()
	{
		return $this->belongsTo(\App\Models\Coordenadore::class, 'coordenadores_SIAPE');
	}

	public function supervisore()
	{
		return $this->belongsTo(\App\Models\Supervisore::class, 'supervisor');
	}

	public function frequencias()
	{
		return $this->hasMany(\App\Models\Frequencia::class, 'estagio_idestagio');
	}
}
