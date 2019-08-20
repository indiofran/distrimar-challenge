<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $table = "employee";

	public function department(){
		return $this->belongsTo('App\Department', 'department');
	}
	public function office(){
		return $this->belongsTo('App\Office', 'office');
	}
	public function manager(){
		return $this->belongsTo('App\Employee', 'manager');
	}
}