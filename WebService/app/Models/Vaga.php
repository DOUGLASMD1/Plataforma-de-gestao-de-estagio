<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 20 Nov 2018 17:16:48 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

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
 * @property \App\Models\Supervisor $supervisor
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
		'status'
	];

	public static function registerVaga($data)
	{	
		$vaga = new Vaga();
		$vaga->fill($data);
		$vaga->save();
		return $vaga;
	}

	public static function updateVaga($data, $idVagas)
	{
		$vaga = self::find($idVagas);
		if(is_null($vaga))
		{
			return false;
		}
		$vaga->fill($data);
		$vaga->save();
		return $vaga;
	}

	public function supervisoR()
	{
		return $this->belongsTo('\App\Models\Supervisor');
	}

	public static function alunos()
	{
		$alunos = DB::table('alunos_has_vagas')
			->join('alunos', 'alunos.rga', '=', 'alunos_has_vagas.alunos_rga')
			->join('vagas', 'vagas.idVagas', '=', 'alunos_has_vagas.vagas_idVagas')
			->select('alunos_rga', 'vagas_idVagas', 'alunos_has_vagas.status')
			->get();
		return $alunos;
	}

	public static function vagas()
	{
		$vagas = DB::table('vagas')
            //->join('supervisores', 'supervisores.users_cpf', '=', 'vagas.supervisor')
			->select('vagas.idVagas', 'vagas.Titulo', 'vagas.Area',
			'vagas.Requisitos_para_Vaga','vagas.status','vagas.idVagas')
			->where('status', '=', 'A')
			->get();
		return $vagas;
	}
}
