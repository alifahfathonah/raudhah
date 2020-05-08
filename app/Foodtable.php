<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foodtable extends Model
{
	//
	protected $table = 'foodtables';
	
	public function examcard()
	{
		return $this->hasMany('App\Examcard');
	}
}