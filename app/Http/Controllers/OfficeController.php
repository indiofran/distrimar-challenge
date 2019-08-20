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
		$offices = Office::with($request->input('rel', []))->paginate($request->input('cant',10),['*'],'p');
		return response()->json($offices);
	}
	public function show(Request $request,Office $office){
		return response()->json($office->load($request->input('rel', []));
	}
}
