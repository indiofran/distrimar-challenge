<?php

namespace App\Http\Controllers;


use App\Employee;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

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
    	try {
			$employees = Employee::with($request->input('rel', []))->paginate((int)$request->input('cant', 10), ['*'], 'p');
			$response = $employees;
			$code = 200;
		}catch (\Exception $e){
			$response = $e->getMessage();
			$code = 500;
		}
		return response()->json($response,$code);

	}
	public function show(Request $request,$id){
    	try {
			$employee = Employee::findOrFail($id);
			$response = $employee->load($request->input('rel', []));
			$code = 200;
		}catch (\Exception $e){
			$response = $e->getMessage();
			$code = 404;
		}
		return response()->json($response,$code);
	}
}
