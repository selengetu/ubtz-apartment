<?php

namespace App\Http\Controllers;

use App\Projecttype;
use Illuminate\Http\Request;
use App\Constructor;
use App\Executor;
use App\Employee;
use App\Project;
use App\State;
use DB;
class BarilgaController extends Controller
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
        $state = State::orderby('state_name_mn')->get();
        $projecttype = Projecttype::orderby('project_type_name_mn')->get();
        $constructor = Constructor::orderby('department_abbr')->get();
        $executor = Executor::orderby('executor_abbr')->get();
        $project =DB::select('select  * from V_PROJECT t order by project_id');
        $employee =DB::select('select  * from V_CONST_EMPLOYEE t order by firstname');
        return view('barilga')->with(['constructor'=>$constructor,'executor'=>$executor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype]);
    }
}
