<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/employees', 'EmployeeController@index');
$router->get('/employees/{employee}', 'EmployeeController@show');
$router->get('/departments', 'DepartmentController@index');
$router->get('/departments/{department}', 'DepartmentController@show');
$router->get('/offices', 'OfficeController@index');
$router->get('/offices/{office}', 'OfficeController@show');
