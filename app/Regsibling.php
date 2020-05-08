<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regsibling extends Model
{
		//
		protected $table = 'regsiblings';

		public function registrant()
		{
			return $this->belongsTo('App\Registrant');
		}
}