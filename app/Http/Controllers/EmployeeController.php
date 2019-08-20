<?php

namespace App\Http\Controllers;


use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
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
		$employees = Employee::with($request->input('rel', []))->paginate($request->input('cant',10),['*'],'p');
		return response()->json($employees);
	}
	public function show(Request $request,Employee $employee){
		return response()->json($employee->load($request->input('rel', [])));
	}
}
