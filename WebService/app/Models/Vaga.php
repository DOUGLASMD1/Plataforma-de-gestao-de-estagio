<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 20 Nov 2018 17:16:48 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Vaga
 * 
 * @property int $idVagas
 * @property string $Titulo
 * @property string $Area
 * @property string $Requisitos_para_Vaga
 * @property string $supervisor
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Supervisore $supervisore
 * @property \Illuminate\Database\Eloquent\Collection $alunos
 *
 * @package App\Models
 */
class Vaga extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $primaryKey = 'idVagas';

	protected $fillable = [
		'Titulo',
		'Area',
		'Requisitos_para_Vaga',
		'supervisor',
		//'status'
	];

	public static function registerVaga($data)
	{	
		$vaga = new Vaga();
		$vaga->fill($data);
		$vaga->save();
		return $vaga;
	}

	public function supervisore()
	{
		return $this->belongsTo(\App\Models\Supervisore::class, 'supervisor');
	}

	public function alunos()
	{
		return $this->belongsToMany(\App\Models\Aluno::class, 'alunos_has_vagas', 'vagas_idVagas', 'alunos_rga')
					->withPivot('status', 'deleted_at')
					->withTimestamps();
	}
}
