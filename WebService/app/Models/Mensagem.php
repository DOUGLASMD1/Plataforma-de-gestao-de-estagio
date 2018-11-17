<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 16 Nov 2018 10:51:08 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Mensagem
 * 
 * @property int $idmensagem
 * @property string $conteudo
 * @property string $users_cpf
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Mensagem extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $primaryKey = 'idmensagem';
	protected $table = 'mensagens';

	protected $fillable = [
		'conteudo',
		'users_cpf'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'users_cpf');
	}
}
