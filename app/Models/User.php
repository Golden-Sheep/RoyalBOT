<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * 
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $phone
 * @property Carbon $days_premium
 * @property string $id_live
 * @property string $fb_poge_id
 * 
 * @property LogIp $log_ip
 * @property Moderator $moderator
 * @property UserBlackList $user_black_list
 * @property UserStarList $user_star_list
 * @property WordsBlackList $words_black_list
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	protected $table = 'user';
	public $timestamps = false;

	protected $dates = [
		'days_premium'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'email',
		'name',
		'password',
		'phone',
		'days_premium',
		'id_live',
        'fb_poge_id',
	];

	public function log_ip()
	{
		return $this->hasOne(LogIp::class, 'idUser');
	}

	public function moderator()
	{
		return $this->hasOne(Moderator::class, 'idUserModerator');
	}

	public function user_black_list()
	{
		return $this->hasOne(UserBlackList::class, 'idUserExecute');
	}

	public function user_star_list()
	{
		return $this->hasOne(UserStarList::class, 'idUser');
	}

	public function words_black_list()
	{
		return $this->hasOne(WordsBlackList::class, 'idUser');
	}

    public function getAuthPassword()
    {
        return bcrypt($this->password);
    }

}
