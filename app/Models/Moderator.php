<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Moderator
 * 
 * @property int $idUserBoss
 * @property int $idUserModerator
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Moderator extends Model
{
	protected $table = 'moderator';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idUserBoss' => 'int',
		'idUserModerator' => 'int'
	];

	protected $fillable = [
		'idUserBoss',
		'idUserModerator'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'idUserModerator');
	}
}
