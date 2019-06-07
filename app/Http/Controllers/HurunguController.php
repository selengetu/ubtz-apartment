<?php

namespace App\Http\Controllers;

use Request;
use App\Constructor;
use App\Employee;
use App\Prof;
use App\Executor;
use DB;
class HurunguController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $executor = Executor::orderby('executor_abbr')->get();
        $constructor = Constructor::orderby('department_abbr')->get();
        return view('hurungu')->with(['executor'=>$executor,'constructor'=>$constructor]);
    }
    public function store()
    {
        $hurungu = new Hurungu;
        $hurungu->depart_id = Request::input('sconstructor_id');
        $hurungu->depart_child = Request::input('schildabbr_id');
        $hurungu->plan = Request::input('plan');
        $hurungu->plan1 = Request::input('plan1');
        $hurungu->plan2 = Request::input('plan2');
        $hurungu->plan3 = Request::input('plan3');
        $hurungu->plan4 = Request::input('plan4');
        $hurungu->budget1 = Request::input('budget1');
        $hurungu->budget2 = Request::input('budget2');
        $hurungu->budget3 = Request::input('budget3');
        $hurungu->budget4 = Request::input('budget4');
        $hurungu->description = Request::input('description');
        $hurungu->save();
        return Redirect('hurungu');
    }

    public function update(Request $request)
    {
        $employee = DB::table('CONST_Employee')
            ->where('emp_id', Request::input('id'))
            ->update(['firstname' => Request::input('firstname'),'lastname' => Request::input('lastname'),'prof_id' => Request::input('prof_id')
                ,'hired_date' => Request::input('date1'),'fired_date' => Request::input('date2'),'mainduty' => Request::input('mainduty'),'phone' => Request::input('phone')]);
        return Redirect('employee');
    }

    public function destroy($id)
    {
        Employee::where('emp_id', '=', $id)->delete();
        return Redirect('employee');
    }
}
