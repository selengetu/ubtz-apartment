<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/collapsemenu/{val}', function($val){
    DB::update("update users set menucollapse = $val where id = ".Auth::user()->id);
});



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/blank', 'HomeController@blank')->name('blank');
Route::get('/barilga', 'BarilgaController@index')->name('barilga');
Route::get('/zaswar', 'ZaswarController@index')->name('zaswar');


Route::get('/executor', 'ExecutorController@index')->name('executor');
Route::get('/destroyexecutor/{id}/delete', ['as' => 'executor.destroy', 'uses' => 'ExecutorController@destroy']);
Route::post('/addexecutor','ExecutorController@store');
Route::post('/updateexecutor','ExecutorController@update');
Route::get('/executorfill/{id?}',function($id = 0){
    $dt=App\Executor::where('executor_id','=',$id)->get();
    return $dt;
});

Route::get('/constructor', 'ConstructorController@index')->name('constructor');
Route::get('/destroyconstructor/{id}/delete', ['as' => 'constructor.destroy', 'uses' => 'ConstructorController@destroy']);
Route::post('/addconstructor','ConstructorController@store');
Route::post('/updateconstructor','ConstructorController@update');
Route::get('/constructorfill/{id?}',function($id = 0){
    $dt=App\Constructor::where('department_id','=',$id)->get();
    return $dt;
});

Route::get('/employee', 'EmployeeController@index')->name('employee');
Route::get('/destroyemployee/{id}/delete', ['as' => 'employee.destroy', 'uses' => 'EmployeeController@destroy']);
Route::post('/addemployee','EmployeeController@store');
Route::post('/updateemployee','EmployeeController@update');
Route::get('/employeefill/{id?}',function($id = 0){
    $dt=App\Employee::where('employee_id','=',$id)->get();
    return $dt;
});

Route::get('/state', 'StateController@index')->name('state');
Route::get('/destroystate/{id}/delete', ['as' => 'state.destroy', 'uses' => 'StateController@destroy']);
Route::post('/addstate','StateController@store');
Route::post('/updatestate','StateController@update');
Route::get('/statefill/{id?}',function($id = 0){
    $dt=App\State::where('state_id','=',$id)->get();
    return $dt;
});