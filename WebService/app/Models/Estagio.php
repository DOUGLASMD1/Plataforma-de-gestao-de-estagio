<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 16 Nov 2018 10:50:30 -0300.
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
 * @property int $supervisores_idSupervisor
 * @property int $coordenadores_SIAPE
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Aluno $aluno
 * @property \App\Models\Coordenador $coordenador
 * @property \App\Models\Supervisor $supervisore
 * @property \Illuminate\Database\Eloquent\Collection $frequencias
 *
 * @package App\Models
 */
class Estagio extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	public $incrementing = false;

	protected $casts = [
		'idestagio' => 'int',
		'supervisores_idSupervisor' => 'int',
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
		'supervisores_idSupervisor',
		'coordenadores_SIAPE'
	];

	public function aluno()
	{
		return $this->belongsTo(\App\Models\Aluno::class, 'alunos_rga');
	}

	public function coordenador()
	{
		return $this->belongsTo(\App\Models\Coordenador::class, 'coordenadores_SIAPE');
	}

	public function supervisor()
	{
		return $this->belongsTo(\App\Models\Supervisor::class, 'supervisores_idSupervisor');
	}

	public function frequencias()
	{
		return $this->hasMany(\App\Models\Frequencia::class, 'estagio_idestagio');
	}
}
