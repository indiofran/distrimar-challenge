<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	protected $table = "department";

	public function superdepartment(){
		return $this->belongsTo('App\Department', 'superdepartment');
	}
	public function subdepartment(){
		return $this->hasMany('App\Department', 'id', 'superdepartment');
	}
	public function employees(){
		return $this->hasMany('App\Employee', 'department');
	}

}