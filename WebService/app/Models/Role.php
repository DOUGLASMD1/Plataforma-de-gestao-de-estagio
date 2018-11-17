<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 15 Nov 2018 20:27:05 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Role
 * 
 * @property int $idrole
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App\Models
 */
class Role extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $primaryKey = 'idrole';

	protected $fillable = [
		'nome'
	];

	public function users()
	{
		return $this->hasMany(\App\Models\User::class, 'roles_idrole');
	}
}
