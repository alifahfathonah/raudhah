<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomorujian extends Model
{
		//
		protected $table = 'nomorujians';

		public function registrant()
		{
			return $this->belongsTo('App\Registrant');
		}
}