<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WordsBlackList
 * 
 * @property int $idUser
 * @property string $word
 * 
 * @property User $user
 *
 * @package App\Models
 */
class WordsBlackList extends Model
{
	protected $table = 'words_black_list';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idUser' => 'int'
	];

	protected $fillable = [
		'idUser',
		'word'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'idUser');
	}
}
