<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constructor;
use App\Employee;
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
        $employee =Employee::orderby('firstname')->get();
        return view('set.employee')->with(['employee'=>$employee]);
    }
    public function store()
    {
        $employee = new Employee;
        $employee->firstname = Request::input('firstname');
        $employee->depart_id = Request::input('depart_id');
        $employee->prof_id = Request::input('prof_id');
        $employee->lastname = Request::input('lastname');
        $employee->save();
        return Redirect('employee');
    }

    public function update(Request $request)
    {
        $employee = DB::table('SET_Employee')
            ->where('employee_id', Request::input('id'))
            ->update(['firstname' => Request::input('firstname'),'lastname' => Request::input('lastname'),'depart_id' => Request::input('depart_id'),'prof_id' => Request::input('prof_id')]);
        return Redirect('employee');
    }

    public function destroy($id)
    {
        Employee::where('employee_id', '=', $id)->delete();
        return Redirect('employee');
    }
}
