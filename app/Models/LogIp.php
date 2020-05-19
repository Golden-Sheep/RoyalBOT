<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LogIp
 * 
 * @property Carbon $date
 * @property string $ip
 * @property int $idUser
 * 
 * @property User $user
 *
 * @package App\Models
 */
class LogIp extends Model
{
	protected $table = 'log_ip';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idUser' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'date',
		'ip',
		'idUser'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'idUser');
	}
}
