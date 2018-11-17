<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 16 Nov 2018 10:50:01 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Curso
 * 
 * @property int $codCurso
 * @property string $nomeCurso
 * @property string $regulamentoEstagio
 * @property string $campus_nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Campus $campus
 * @property \Illuminate\Database\Eloquent\Collection $alunos
 * @property \Illuminate\Database\Eloquent\Collection $coordenadores
 *
 * @package App\Models
 */
class Curso extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $primaryKey = 'codCurso';
	public $incrementing = false;

	protected $casts = [
		'codCurso' => 'int'
	];

	protected $fillable = [
		'nomeCurso',
		'regulamentoEstagio',
		'campus_nome'
	];

	public function campus()
	{
		return $this->belongsTo(\App\Models\Campus::class, 'campus_nome');
	}

	public function alunos()
	{
		return $this->hasMany(\App\Models\Aluno::class, 'cursos_codCurso');
	}

	public function coordenadores()
	{
		return $this->hasMany(\App\Models\Coordenador::class, 'cursos_codCurso');
	}
}
