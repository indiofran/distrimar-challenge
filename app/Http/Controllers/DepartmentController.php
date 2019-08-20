<?php

namespace App\Http\Controllers;


use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request){

		$departments = Department::with($request->input('rel', []))->paginate($request->input('cant',10),['*'],'p');

		return response()->json($departments);
	}
	public function show(Request $request, Department $department){
		return response()->json($department->load($request->input('rel', [])));
	}
}
