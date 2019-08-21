<?php

namespace App\Http\Controllers;


use App\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
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
			$offices = Office::with($request->input('rel', []))->paginate((int)$request->input('cant', 10), ['*'], 'p');
			$response = $offices;
			$code = 200;
		}catch (\Exception $e){
			$response = $e->getMessage();
			$code = 500;
		}
		return response()->json($response,$code);

	}
	public function show(Request $request,$id){
		try {
			$office = Office::findOrFail($id);
			$response = $office->load($request->input('rel', []));
			$code = 200;
		}catch (\Exception $e){
			$response = $e->getMessage();
			$code = 404;
		}
		return response()->json($response,$code);
	}
}
