<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserStarList
 * 
 * @property string $idFacebook
 * @property int $idUser
 * 
 * @property User $user
 *
 * @package App\Models
 */
class UserStarList extends Model
{
	protected $table = 'user_star_list';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idUser' => 'int'
	];

	protected $fillable = [
		'idFacebook',
		'idUser'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'idUser');
	}
}
