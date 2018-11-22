<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 21 Nov 2018 22:13:18 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Arquivo
 * 
 * @property int $idarquivo
 * @property string $filename
 * @property string $tipo
 * @property string $path
 * @property int $size
 * @property int $coor_siape
 * @property string $aluno_rga
 * @property string $super_users_cpf
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Aluno $aluno
 * @property \App\Models\Coordenadore $coordenadore
 * @property \App\Models\Supervisore $supervisore
 *
 * @package App\Models
 */
class Arquivo extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $primaryKey = 'idarquivo';

	protected $casts = [
		'size' => 'int',
		'coor_siape' => 'int'
	];

	protected $fillable = [
		'filename',
		'tipo',
		'path',
		'size',
		'coor_siape',
		'aluno_rga',
		'super_users_cpf'
	];

	public function aluno()
	{
		return $this->belongsTo(\App\Models\Aluno::class, 'aluno_rga');
	}

	public function coordenadore()
	{
		return $this->belongsTo(\App\Models\Coordenadore::class, 'coor_siape');
	}

	public function supervisore()
	{
		return $this->belongsTo(\App\Models\Supervisore::class, 'super_users_cpf');
	}
}
