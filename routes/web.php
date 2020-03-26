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

Route::group(['middleware' => 'locale'], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/collapsemenu/{val}', function($val){
    DB::update("update users set menucollapse = $val where id = ".Auth::user()->id);
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/blank', 'HomeController@blank')->name('blank');



Route::match(['get', 'post'],'/barilga', 'BarilgaController@index')->name('barilga');
Route::match(['get', 'post'],'/zaswar', 'BarilgaController@index')->name('zaswar');
Route::post('/addproject','BarilgaController@store');
Route::get('/project/delete/{id}', 'BarilgaController@destroy');
Route::post('/updateproject','BarilgaController@update');
Route::post('/approveproj','BarilgaController@approve');
Route::get('/projectfill/{id?}',function($id = 0){
    $dt=DB::table('V_PROJECT')->where('project_id','=',$id)->get();
    return $dt;
});

Route::match(['get', 'post'],'/zaswar', 'BarilgaController@index')->name('zaswar');


Route::get('/process', 'ProcessController@index')->name('process');
Route::post('/addprocess','ProcessController@store');
Route::get('/process/delete/{id}/{id1}', 'ProcessController@destroy');
Route::post('/updateprocess','ProcessController@update');
Route::post('/approveproc','ProcessController@approve');
Route::get('/processfill/{id?}',function($id = 0){
    $dt=DB::table('V_PROCESS')->where('process_id','=',$id)->get();
    return $dt;
});
Route::get('/projectprocessfill/{id?}',function($id = 0){
    $dt=DB::table('V_PROCESS')->where('project_id','=',$id)->orderby('process_id')->get();
    return $dt;
});

    Route::match(['get', 'post'],'/hurungu', 'HurunguController@index')->name('hurungu');
    Route::get('hurungu/delete/{id}', 'HurunguController@destroy');
    Route::post('/addhurungu','HurunguController@store');
    Route::post('/updatehurungu','HurunguController@update');
    Route::get('/hurungufill/{id?}',function($id = 0){
        $dt=App\Hurungu::where('investment_id','=',$id)->get();
        return $dt;
    });



Route::get('/executor', 'ExecutorController@index')->name('executor');
Route::get('/executor/delete/{id}', 'ExecutorController@destroy');
Route::post('/addexecutor','ExecutorController@store');
Route::post('/updateexecutor','ExecutorController@update');
Route::get('/executorfill/{id?}',function($id = 0){
    $dt=App\Executor::where('executor_id','=',$id)->get();
    return $dt;
});

Route::get('/constructor', 'ConstructorController@index')->name('constructor');
Route::get('/constructor/delete/{id}', 'ConstructorController@destroy');
Route::post('/addconstructor','ConstructorController@store');
Route::post('/updateconstructor','ConstructorController@update');
Route::get('/constructorfill/{id?}',function($id = 0){
    $dt=App\Constructor::where('department_id','=',$id)->get();
    return $dt;
});

Route::get('/employee', 'EmployeeController@index')->name('employee');
Route::get('/employee/delete/{id}', 'EmployeeController@destroy');
Route::post('/addemployee','EmployeeController@store');
Route::post('/updateemployee','EmployeeController@update');
Route::get('/employeefill/{id?}',function($id = 0){
    $dt=App\Employee::where('emp_id','=',$id)->get();
    return $dt;
});

Route::get('/state', 'StateController@index')->name('state');
Route::get('/state/delete/{id}', 'StateController@destroy');
Route::post('/addstate','StateController@store');
Route::post('/updatestate','StateController@update');
Route::get('/statefill/{id?}',function($id = 0){
    $dt=App\State::where('state_id','=',$id)->get();
    return $dt;
});

Route::get('/method', 'MethodController@index')->name('method');
Route::get('/method/delete/{id}', 'MethodController@destroy');
Route::post('/addmethod','MethodController@store');
Route::post('/updatemethod','MethodController@update');
Route::get('/methodfill/{id?}',function($id = 0){
    $dt=App\Method::where('method_code','=',$id)->get();
    return $dt;
});

Route::get('/prof', 'ProfController@index')->name('prof');
Route::get('/prof/delete/{id}', 'ProfController@destroy');
Route::post('/addprof','ProfController@store');
Route::post('/updateprof','ProfController@update');
Route::get('/proffill/{id?}',function($id = 0){
    $dt=App\Prof::where('profession_id','=',$id)->get();
    return $dt;
});

Route::get('/projecttype', 'ProjecttypeController@index')->name('projecttype');
Route::get('/projecttype/delete/{id}', 'ProjecttypeController@destroy');
Route::post('/addprojecttype','ProjecttypeController@store');
Route::post('/updateprojecttype','ProjecttypeController@update');
Route::get('/projecttypefill/{id?}',function($id = 0){
    $dt=App\Projecttype::where('project_type_id','=',$id)->get();
    return $dt;
});
Route::match(['get', 'post'],'/main', 'TailanController@index')->name('main');
Route::match(['get', 'post'],'/mainib', 'TailanController@index')->name('mainib');
Route::match(['get', 'post'],'/mainhu', 'TailanController@hurungu')->name('mainhu');
Route::match(['get', 'post'],'/time', 'TailanController@time')->name('time');
Route::match(['get', 'post'],'/geree', 'TailanController@geree')->name('geree');
Route::match(['get', 'post'],'/analyseib', 'TailanController@analyse')->name('analyseib');
Route::match(['get', 'post'],'/analyseiz', 'TailanController@analyse')->name('analyseiz');
Route::match(['get', 'post'],'/analysehu', 'TailanController@analysehu')->name('analysehu');
Route::match(['get', 'post'],'/album', 'TailanController@album')->name('album');
Route::match(['get', 'post'],'/detailib', 'TailanController@detail')->name('detailib');
Route::match(['get', 'post'],'/detailiz', 'TailanController@detail')->name('detailiz');

Route::get('/profile', 'UserController@index')->name('profile');
Route::post('/changePassword','UserController@postCredentials');
Route::get('/getexec/{id?}',function($id = 0){
    if ($id == 3)
    {
        $dt=DB::table('V_EXECUTOR')
            ->where('is_ubtz','=',0)->orderby('executor_name')->get();
        return $dt;

    } else{
        $dt=DB::table('V_EXECUTOR')
            ->where('is_ubtz','=',1)->orderby('executor_name')->get();
        return $dt;
    }

});


Route::get('/chartfill/{id?}',function($id = 0){
    $dt=DB::table('V_TAILAN_PROJ_CHILD')->where('department_id','=',$id)->where('plan_year','=',2020)->get();
    return $dt;
});
    Route::get('/chartfillt/{id?}/{id1?}/{id2?}',function($id = 0,$id1 = 0,$id2= 0){
        $dt=DB::table('V_TAILAN_PROJ_CHILDTYPE')->where('department_id','=',$id)->where('project_type','=',$id1)->where('plan_year','=',$id2)->get();
        return $dt;
    });
Route::get('setlocale/{locale}',function($locale){
    Session::put('locale', $locale);
    return redirect()->route('home');
});
    Route::get('/getimage/{id?}',function($id = 0){
        $dt=DB::table('V_PROCESS_IMG')->where('project_id','=',$id)->get();
        return $dt;
    });
    Route::get('/getimagedet/{id?}',function($id = 0){
        $dt=DB::table('V_PROCESS_IMG')->where('process_id','=',$id)->get();
        return $dt;
    });
    Route::get('/information', 'InformationController@index')->name('information');
    Route::get('/information/delete/{id}', 'InformationController@destroy');
    Route::post('/addinformation','InformationController@store');
    Route::post('/updateinformation','InformationController@update');
    Route::get('/informationfill/{id?}',function($id = 0){
        $dt=DB::table('V_INFORMATION')->where('information_id','=',$id)->get();
        return $dt;
    });
    Route::match(['get', 'post'],'/hurungurep', 'HurunguController@report')->name('hurungurep');
    Route::get('/customers/pdf','TailanController@export_pdf');
    Route::get('/picture/delete/{id}/{id1}', 'ProcessController@deletepicture');

    Route::get('/filter_resp/{date}', 'BarilgaController@filter_resp');
    Route::get('/filter_method/{date}', 'BarilgaController@filter_method');
    Route::get('/filter_state/{date}', 'BarilgaController@filter_state');
    Route::get('/filter_childabbr/{date}', 'BarilgaController@filter_childabbr');
    Route::get('/filter_executor/{date}', 'BarilgaController@filter_executor');
    Route::get('/filter_year/{date}', 'BarilgaController@filter_year');
    Route::get('/filter_month/{date}', 'BarilgaController@filter_month');
});