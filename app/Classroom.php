<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
	//
	protected $table = 'classrooms';
	
	public function building()
	{
		return $this->belongsTo('App\Building');
	}
	public function examcard()
	{
		return $this->hasMany('App\Examcard');
	}
}