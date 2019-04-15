<?php

namespace App\Http\Controllers;

use Request;
use App\Constructor;
use App\Employee;
use App\Prof;
use DB;
class EmployeeController extends Controller
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
        $prof =Prof::orderby('profession_id')->get();
        $employee =DB::select('select  * from V_CONST_EMPLOYEE t order by firstname');
        return view('set.employee')->with(['employee'=>$employee,'prof'=>$prof]);
    }
    public function store()
    {
        $employee = new Employee;
        $employee->firstname = Request::input('firstname');
        $employee->depart_id = 22;
        $employee->prof_id = Request::input('prof_id');
        $employee->lastname = Request::input('lastname');
        $employee->hired_date = Request::input('date1');
        $employee->fired_date = Request::input('date2');
        $employee->mainduty = Request::input('mainduty');
        $employee->phone = Request::input('phone');
        $employee->save();
        return Redirect('employee');
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
