<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regschool extends Model
{
	//
	protected $table = 'regschools';

	public function registrant()
	{
		return $this->belongsTo('App\Registrant');
	}
}