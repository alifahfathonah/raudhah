<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regparent extends Model
{
		//
		protected $table = 'regparents';

		public function registrants()
		{
			return $this->belongsTo('App\Registrant');
		}
}