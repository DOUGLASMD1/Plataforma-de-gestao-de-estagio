<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 16 Nov 2018 10:49:32 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Arquivo
 * 
 * @property int $idArquivo
 * @property string $tipo_arquivo
 * @property boolean $arquivo
 * @property string $alunos_rga
 * @property int $supervisores_idSupervisor
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Aluno $aluno
 * @property \App\Models\Supervisor $supervisor
 *
 * @package App\Models
 */
class Arquivo extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $primaryKey = 'idArquivo';

	protected $casts = [
		'arquivo' => 'boolean',
		'supervisores_idSupervisor' => 'int'
	];

	protected $fillable = [
		'tipo_arquivo',
		'arquivo',
		'alunos_rga',
		'supervisores_idSupervisor',
		'status'
	];

	public function aluno()
	{
		return $this->belongsTo(\App\Models\Aluno::class, 'alunos_rga');
	}

	public function supervisores()
	{
		return $this->belongsTo(\App\Models\Supervisor::class, 'supervisores_idSupervisor');
	}
}
