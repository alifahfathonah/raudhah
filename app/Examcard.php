<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examcard extends Model
{
	//
	protected $table = 'examcards';
	
	public function registrant()
	{
		return $this->belongsTo('App\Registrant');
	}
	public function room()
	{
		return $this->belongsTo('App\Room');
	}
	public function classroom()
	{
		return $this->belongsTo('App\Classroom');
	}
	public function foodtable()
	{
		return $this->belongsTo('App\Foodtable');
	}
}