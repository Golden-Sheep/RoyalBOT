<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserBlackList
 * 
 * @property string $idFacebook
 * @property int $idUser
 * @property int $idUserExecute
 * @property string $comment
 * @property string $motivo
 * 
 * @property User $user
 *
 * @package App\Models
 */
class UserBlackList extends Model
{
	protected $table = 'user_black_list';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idUser' => 'int',
		'idUserExecute' => 'int'
	];

	protected $fillable = [
		'idFacebook',
		'idUser',
		'idUserExecute',
		'comment',
		'motivo'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'idUserExecute');
	}
}
