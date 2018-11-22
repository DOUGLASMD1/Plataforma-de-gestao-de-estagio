<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 21 Nov 2018 21:10:10 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;


/**
 * Class AlunosHasVaga
 * 
 * @property string $alunos_rga
 * @property int $vagas_idVagas
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Aluno $aluno
 * @property \App\Models\Vaga $vaga
 *
 * @package App\Models
 */
class AlunosHasVaga extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	public $incrementing = false;

	protected $casts = [
		'vagas_idVagas' => 'int'
	];

	protected $fillable = [
		'status'
	];

	public function aluno()
	{
		return $this->belongsTo(\App\Models\Aluno::class, 'alunos_rga');
	}

	public function vaga()
	{
		return $this->belongsTo(\App\Models\Vaga::class, 'vagas_idVagas');
	}

	public static function updateAlunoVaga($data)
	{	
		DB::select('call update_alunos_has_vagas(?,?,?)',array(
			$data['Status'],
			$data['Aluno'],
			$data['Vaga'],
		));
	}
}
