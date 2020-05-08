<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Registrant extends Authenticatable
{
	use Notifiable;
	protected $guard = 'registrant';
	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'indexno',
		'years',
		'nova',
		'email',
		'destination', 
		'password', 
		'kknumber', 
		'username', 
		'name', 
		'nickname', 
		'nisn', 
		'gender', 
		'bloodtype', 
		'weight', 
		'height', 
		'birthplace', 
		'birthdate', 
		'consulat', 
		'hobby', 
		'wishes', 
		'achievement', 
		'competition', 
		'siblings', 
		'stepsiblings', 
		'totalsiblings', 
		'numposition',
	];
	
	/**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
		'password', 'remember_token',
	];
	
	/**
	* The attributes that should be cast to native types.
	*
	* @var array
	*/
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function regsibling()
	{
		return $this->hasMany('App\Regsibling');
	}

	public function regschool()
	{
		return $this->hasOne('App\Regschool');
	}

	public function regparent()
	{
		return $this->hasOne('App\Regparent');
	}

	public function regstep()
	{
		return $this->hasOne('App\Regstep');
	}

	public function examcard()
	{
		return $this->hasOne('App\Examcard');
	}
}