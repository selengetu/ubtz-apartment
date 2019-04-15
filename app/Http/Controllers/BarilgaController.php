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
    public function store()
    {
        $project = new Project;
        $project->plan_year = Request::input('plan_year');
        $project->project_name = Request::input('project_name');
        $project->budget = Request::input('budget');
        $project->estimation = Request::input('estimation');
        $project->plan = Request::input('plan');
        $project->department_id = Request::input('department_id');
        $project->project_type = Request::input('project_type');
        $project->respondent_emp_id = Request::input('respondent_emp_id');
        $project->state_id = Request::input('state_id');
        $project->method_code = Request::input('method_code');
        $project->percent = Request::input('percent');
        $project->executor_id = Request::input('executor_id');
        $project->project_name_ru = Request::input('project_name_ru');
        $project->economic = Request::input('economic');
        $project->description = Request::input('description');
        $project->save();
        return Redirect('barilga');
    }

    public function update(Request $request)
    {
        $project = DB::table('Project')
            ->where('emp_id', Request::input('id'))
            ->update(['plan_year' => Request::input('plan_year'),'project_name' => Request::input('project_name'),'budget' => Request::input('budget')
                ,'estimation' => Request::input('estimation'),'plan' => Request::input('plan'),'department_id' => Request::input('department_id')
                ,'project_type' => Request::input('project_type'),'respondent_emp_id' => Request::input('respondent_emp_id'),'state_id' => Request::input('state_id')
                ,'method_code' => Request::input('method_code'),'percent' => Request::input('percent'),'executor_id' => Request::input('executor_id')
                ,'project_name_ru' => Request::input('project_name_ru'),'economic' => Request::input('economic'),'description' => Request::input('description')]);
        return Redirect('barilga');
    }

    public function destroy($id)
    {
        Project::where('project_id', '=', $id)->delete();
        return Redirect('barilga');
    }
}
