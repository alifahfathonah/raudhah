<?php

namespace App\Providers;

use App\Setting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	* Register any application services.
	*
	* @return void
	*/
	public function register()
	{
		//
	}
	
	/**
	* Bootstrap any application services.
	*
	* @return void
	*/
	public function boot()
	{
		//
		$set = Setting::first();
		view()->share(['set' => $set]);
	}
}