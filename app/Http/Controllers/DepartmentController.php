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
		try {
			$departments = Department::with($request->input('rel', []))->paginate((int)$request->input('cant', 10), ['*'], 'p');
			$response = $departments;
			$code = 200;
		}catch (\Exception $e){
			$response = $e->getMessage();
			$code = 500;
		}
		return response()->json($response,$code);

	}
	public function show(Request $request,$id){
		try {
			$department = Department::findOrFail($id);
			$response = $department->load($request->input('rel', []));
			$code = 200;
		}catch (\Exception $e){
			$response = $e->getMessage();
			$code = 404;
		}
		return response()->json($response,$code);
	}
}
