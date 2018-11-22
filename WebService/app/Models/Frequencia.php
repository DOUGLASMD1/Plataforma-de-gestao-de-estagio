<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 16 Nov 2018 10:50:42 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Frequencia
 * 
 * @property int $idFrequencia
 * @property \Carbon\Carbon $Data_inicio
 * @property \Carbon\Carbon $data_fim
 * @property string $Descricao_aluno
 * @property string $Descricao_Supervisor
 * @property string $status
 * @property int $estagio_idestagio
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Estagio $estagio
 *
 * @package App\Models
 */
class Frequencia extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $primaryKey = 'idFrequencia';

	protected $casts = [
		'estagio_idestagio' => 'int'
	];

	protected $dates = [
		'Data_inicio',
		'data_fim'
	];

	protected $fillable = [
		'Data_inicio',
		'data_fim',
		'Descricao_aluno',
		'Descricao_Supervisor',
		'status',
		'estagio_idestagio'
	];

	public static function registerFrequencia($data)
	{	
		$freq = new Frequencia();
		$freq->fill($data);
		$freq->save();
		return $freq;
	}

	public static function updateFrequencia($data, $idFrequencia)
	{
		$freq = self::find($idFrequencia);
		if(is_null($freq))
		{
			return false;
		}
		$freq->fill($data);
		$freq->save();
		return $freq;
	}

	public function estagio()
	{
		return $this->belongsTo(\App\Models\Estagio::class, 'estagio_idestagio');
	}
}
