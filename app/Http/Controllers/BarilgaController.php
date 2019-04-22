<?php

namespace App\Http\Controllers;

use App\Projecttype;
use Request;
use App\Constructor;
use App\Executor;
use App\Employee;
use App\Project;
use App\Method;
use App\State;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;
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
        $query = "";
        $state = State::orderby('state_name_mn')->get();
        $method = Method::orderby('method_name')->get();
        $projecttype = Projecttype::orderby('project_type_name_mn')->get();
        $constructor = Constructor::orderby('department_abbr')->get();
        $executor = Executor::orderby('executor_abbr')->get();

        $employee =DB::select('select  * from V_CONST_EMPLOYEE t order by firstname');

        $sstate_id= Input::get('sstate_id');
        $sexecutor = Input::get('sexecutor_id');
        $sconstructor = Input::get('sconstructor_id');
        $srespondent_emp_id = Input::get('srespondent_emp_id');
        $sprojecttype= Input::get('sproject_type');
        $enddate = Input::get('date2');
        $startdate= Input::get('date1');
        $enddate = Input::get('date2');

        if ($startdate !=0 && $startdate && $enddate !=0 && $enddate !=NULL) {
            $query.=" where start_date between '".$startdate."' and '".$enddate." 23:59:59'";

        }
        else
        {
            $query.=" ";

        }
        if ($sprojecttype!=NULL && $sprojecttype !=0) {
            $query.=" and project_type = '".$sprojecttype."'";

        }
        else
        {
            $query.=" ";

        }
        if ($sexecutor!=NULL && $sexecutor !=0) {
            $query.=" and executor_id = '".$sexecutor."'";

        }
        else
        {
            $query.=" ";

        }
        if ($sconstructor!=NULL && $sconstructor !=0) {
            $query.=" and department_id = '".$sconstructor."'";

        }
        else
        {
            $query.=" ";

        }
        if ($srespondent_emp_id!=NULL && $srespondent_emp_id !=0) {
            $query.=" and respondent_emp_id = '".$srespondent_emp_id."'";

        }
        else
        {
            $query.=" ";

        }
        if ($sstate_id!=NULL && $sstate_id !=0) {
            $query.=" and state_id = '".$sstate_id."'";

        }
        else
        {
            $query.=" ";

        }
        $project =DB::select("select  * from V_PROJECT t  where 1=1 " .$query. " order by project_id");
        return view('barilga')->with(['method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype]);
    }
    public function store()
    {

        $project = new Project;
        $project->plan_year = 2019;
        $project->project_name = Request::input('project_name');
        $project->budget =preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('budget'));
        $project->estimation = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('estimation'));
        $project->plan = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan'));
        $project->department_id = Request::input('constructor_id');
        $project->project_type = Request::input('project_type');
        $project->respondent_emp_id = Request::input('respondent_emp_id');
        $project->state_id = Request::input('state_id');
        $project->method_code = Request::input('method_code');
        $project->percent = Request::input('percent');
        $project->executor_id = Request::input('executor_id');
        $project->added_user_id = Auth::user()->id;
        $project->project_name_ru = Request::input('project_name_ru');
        $project->economic = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('economic'));
        $project->description = Request::input('description');
        $project->start_date = Request::input('date1');
        $project->end_date = Request::input('date2');
        $project->save();
        return Redirect('barilga');
    }

    public function update(Request $request)
    {
        $project = DB::table('Project')
            ->where('project_id', Request::input('id'))
            ->update(['plan_year' => Request::input('plan_year'),'project_name' => Request::input('project_name'),'budget' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('budget'))
                ,'estimation' =>preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('estimation')),'plan' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan')),'department_id' => Request::input('constructor_id')
                ,'project_type' => Request::input('project_type'),'respondent_emp_id' => Request::input('respondent_emp_id'),'state_id' => Request::input('state_id'),'start_date' => Request::input('date1'),'end_date' => Request::input('date2')
                ,'method_code' => Request::input('method_code'),'percent' => Request::input('percent'),'executor_id' => Request::input('executor_id')
                ,'project_name_ru' => Request::input('project_name_ru'),'economic' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('economic')),'description' => Request::input('description')]);
        return Redirect('barilga');
    }

    public function destroy($id)
    {
        Project::where('project_id', '=', $id)->delete();
        return Redirect('barilga');
    }
}
