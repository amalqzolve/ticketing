<?php

// This is the Stats class I wanted to create. It lives in app/Stats.php, but could be anywhere that the AutoLoader will recognise it

namespace App;

use App\User;
use Carbon\Carbon;

/**
* 
*/
class Stats 
{

	private $now;
	public  $today     = 0;
	public  $yesterday = 0;
	public  $week      = 0;
	public  $month     = 0;
	public  $year      = 0;
	
	function __construct()
	{
		$this->now = Carbon::now();
		$this->constructToday();
		$this->constructYesterday();
		$this->constructMonth();
		$this->constructYear();
	}

	function constructToday() {
		$this->today = User::whereDate( 'created_at', $this->now->toDateString() )->count();
	}

	function constructYesterday() {
		$yesterday = Carbon::yesterday();
		$this->yesterday = User::whereDate( 'created_at', $yesterday->toDateString() )->count();
	}

	function constructMonth() {
		$this->month = User::whereMonth( 'created_at', $this->now->month )->count();
	}

	function constructYear() {
		$this->year = User::whereYear( 'created_at', $this->now->year )->count();
	}

}