<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regstep extends Model
{
	//
	protected $table = 'regsteps';
	
	protected $fillable = [
		'registrant_id',
		'stepreg',
		'steppay',
	];

	public function registrant()
	{
		return $this->belongsTo('App\Registrant');
	}
}