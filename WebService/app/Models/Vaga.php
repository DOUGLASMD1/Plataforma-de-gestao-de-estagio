<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 16 Nov 2018 10:52:07 -0300.
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
 * @property int $supervisores_idSupervisor
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
	public $incrementing = false;

	protected $casts = [
		'idVagas' => 'int',
		'supervisores_idSupervisor' => 'int'
	];

	protected $fillable = [
		'Titulo',
		'Area',
		'Requisitos_para_Vaga',
		'status'
	];

	public function supervisore()
	{
		return $this->belongsTo(\App\Models\Supervisore::class, 'supervisores_idSupervisor');
	}

	public function alunos()
	{
		return $this->belongsToMany(\App\Models\Aluno::class, 'alunos_has_vagas', 'vagas_idVagas', 'alunos_rga')
					->withPivot('status', 'deleted_at')
					->withTimestamps();
	}
}
