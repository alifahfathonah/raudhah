<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
	//
	protected $table = 'buildings';

	public function room()
	{
		return $this->hasMany('App\Room');
	}
	public function classroom()
	{
		return $this->hasMany('App\Classroom');
	}
}