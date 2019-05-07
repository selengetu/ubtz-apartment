<?php

namespace App\Http\Controllers;

use App\Projecttype;
use Carbon\Carbon;
use Request;
use Session;
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

        $employee =DB::select('select  * from V_CONST_EMPLOYEE t where t.is_engineer=1 order by firstname');

        $sstate_id= Input::get('sstate_id');
        $sexecutor = Input::get('sexecutor_id');
        $sconstructor = Input::get('sconstructor_id');
        $srespondent_emp_id = Input::get('srespondent_emp_id');
        $sprojecttype= Input::get('sproject_type');
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
        $gproject_id = 0;
        if( Session::has('gproject_id') ) {
            $gproject_id = Session::get('gproject_id');
        }

        $project =DB::select("select  * from V_PROJECT t  where 1=1 " .$query. " order by project_id");
        return view('barilga')->with(['gproject_id'=>$gproject_id,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype]);
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
        if (Request::input('respondent_emp_id')!=NULL && Request::input('respondent_emp_id') !=0) {

            $project->respondent_emp_id = Request::input('respondent_emp_id');
        }
        else{

            $project->respondent_emp_id =999;
        }

        $project->state_id = 15;
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
                ,'plan' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan')),'department_id' => Request::input('constructor_id')
                ,'project_type' => Request::input('project_type'),'start_date' => Request::input('date1'),'end_date' => Request::input('date2')
                ,'method_code' => Request::input('method_code'),'percent' => Request::input('percent'),'executor_id' => Request::input('executor_id')
                ,'project_name_ru' => Request::input('project_name_ru'),'economic' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('economic')),'description' => Request::input('description')]);

       if(Auth::user()->id ==53 )
       {
           $project = DB::table('Project')
               ->where('project_id', Request::input('id'))
               ->update(['respondent_emp_id' => Request::input('respondent_emp_id')]);
       }
        if(Auth::user()->id ==45 )
        {
            $project = DB::table('Project')
                ->where('project_id', Request::input('id'))
                ->update(['estimation' =>preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('estimation'))]);
        }
        $data= Request::input('id');
        $state = DB::select("select t.state_id as state from V_PROCESS t where t.process_id = (select max(v.process_id) from V_PROCESS v where v.project_id=".$data.")");
        $est = DB::select("select estimation from V_PROJECT t where t.project_id=".$data."");

        $budget = DB::select("select sum(t.budget) as totalbudget from V_PROCESS t where t.project_id=".$data."");

        if($budget[0]->totalbudget!=NULL && $budget[0]->totalbudget !=0)
        {
            $percent=($budget[0]->totalbudget / $est[0]->estimation)*100;
            $process = DB::table('Project')
                ->where('project_id',$data)
                ->update(['budget' => $budget[0]->totalbudget ,'state_id' => $state[0]->state,'percent' => $percent]);
        }

        return Redirect('barilga');
    }
    public function approve(Request $request)
    {
        $project = DB::table('Project')
            ->where('project_id', Request::input('id'))
            ->update(['is_approved' =>1,'approved_date' =>Carbon::today(),'approved_id' =>Auth::user()->id]);

        return Redirect('barilga');
    }
    public function destroy($id)
    {
        Project::where('project_id', '=', $id)->delete();

        return Redirect('barilga');
    }
}
