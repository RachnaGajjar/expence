<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Transaction extends Model
{
    //
	protected $dates = ['tr_date'];

	public function setUserAttribute(User $user)
	{
		$this->user_id = $user->id;
	}

	public static function getByDate(User $user, $dt)
	{
		// dd(static::where('user_id', $user->id)->whereRaw('MONTH(`tr_date`) = 5')->get());
		if($dt['date'] && $dt['date'] >= 1 && $dt['date'] <= 31) {
			return static::getByMonth($user, $dt)
				->whereRaw("DAY(`tr_date`) = " . $dt['date']);
		}
		throw new Exception("Invalid Date", 1);
		
	}

	public static function getByMonth(User $user, $dt)
	{
		if($dt['month'] && $dt['month'] >= 1 && $dt['month'] <= 12) {
			return static::getByYear($user, $dt)
				->whereRaw("MONTH(`tr_date`) = " . $dt['month']);
		}
		throw new Exception("Invalid Month", 1);
	}

	public static function getByYear(User $user, $dt)
	{
		if($dt['year'] && $dt['year'] > 1900 && $dt['year'] < 2200) {
			return static::where('user_id', $user->id)
				->whereRaw("YEAR(`tr_date`) = " . $dt['year']);
		}
		throw new Exception("Invalid Year", 1);
		
	}

}
