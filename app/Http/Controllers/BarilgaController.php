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
use App\Process;
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
        $schildabbr= Input::get('schildabbr_id');
        $smethod_id= Input::get('smethod_id');
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
            $sprojecttype=0;
            $query.=" ";


        }
        if ($sexecutor!=NULL && $sexecutor !=0) {
            $query.=" and executor_id = '".$sexecutor."'";

        }
        else
        {
            $sexecutor=0;
            $query.=" ";

        }
        if ($sconstructor!=NULL && $sconstructor !=0) {
            $query.=" and department_id = '".$sconstructor."'";

        }
        else
        {
            $sconstructor=0;
            $query.=" ";

        }
        if ($schildabbr!=NULL && $schildabbr !=0) {
            $query.=" and department_child = '".$schildabbr."'";

        }
        else
        {
            $schildabbr=0;
            $query.=" ";

        }
        if ($smethod_id!=NULL && $smethod_id !=0) {
            $query.=" and method_code = '".$smethod_id."'";

        }
        else
        {
            $smethod_id=0;
            $query.=" ";

        }
        if ($srespondent_emp_id!=NULL && $srespondent_emp_id !=0) {
            $query.=" and respondent_emp_id = '".$srespondent_emp_id."'";

        }
        else
        {
            $srespondent_emp_id=0;
            $query.=" ";

        }
        if ($sstate_id!=NULL && $sstate_id !=0) {
            $query.=" and state_id = '".$sstate_id."'";

        }
        else
        {
            $sstate_id=0;
            $query.=" ";

        }
        $gproject_id = 0;
        if( Session::has('gproject_id') ) {
            $gproject_id = Session::get('gproject_id');
        }

        $project =DB::select("select  * from V_PROJECT t  where 1=1 " .$query. " order by project_id");
        return view('barilga')->with(['schildabbr'=>$schildabbr,'smethod_id'=>$smethod_id,'sstate_id'=>$sstate_id,'srespondent_emp_id'=>$srespondent_emp_id,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'sprojecttype'=>$sprojecttype,'gproject_id'=>$gproject_id,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'employee'=>$employee,'method'=>$method,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype]);
    }
    public function store()
    {

        $project = new Project;
        $project->plan_year = 2019;
        $project->project_name = Request::input('project_name');
        $project->project_name_ru = Request::input('project_name_ru');
        $project->budget =preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('budget'));
        $project->contract =preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('geree'));
        $project->estimation = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('estimation'));
        $project->plan = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan'));
        $project->plan1 = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan1'));
        $project->plan2 = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan2'));
        $project->plan3 = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan3'));
        $project->plan4 = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan4'));
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
        $project->department_child = Request::input('childabbr_id');
        $project->added_user_id = Auth::user()->id;
        $project->project_name_ru = Request::input('project_name_ru');
        $project->economic = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('economic'));
        $project->description = Request::input('description');
        $project->start_date = Request::input('date1');
        $project->end_date = Request::input('date2');
        $project->save();
        $LastInsertId = $project->project_id;
        $LastEmpId = $project->respondent_emp_id;

        $month = DB::select("select  * from CONST_MONTH");
        foreach ($month as $row) {
            $process = new Process;
            $process ->project_id = $LastInsertId;
            $process ->budget = 0;
            $process ->month =$row->month_num;
            $process ->register_date = Carbon::now();
            $process ->respondent_emp_id = $LastEmpId;
            $process ->year = Carbon::now()->format('Y');
            $process ->state_id = 15;
            $process->save();

        }
        activity()->performedOn($project)->log('Project added');
        return Redirect('barilga');
    }

    public function update(Request $request)
    {
        $project = DB::table('Project')
            ->where('project_id', Request::input('id'))
            ->update(['plan_year' => Request::input('plan_year'),'project_name' => Request::input('project_name'),'project_name_ru' => Request::input('project_name_ru'),'budget' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('budget'))
               , 'contract' =>preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('geree')) ,'estimation' =>preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('estimation')) ,'plan' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan')),'department_id' => Request::input('constructor_id'),'department_child' => Request::input('childabbr_id')
                ,'plan1' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan1')),'plan2' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan2'))
                ,'plan3' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan3')),'plan4' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan4'))
                ,'project_type' => Request::input('project_type'),'start_date' => Request::input('date1'),'end_date' => Request::input('date2')
                ,'method_code' => Request::input('method_code'),'percent' => Request::input('percent'),'executor_id' => Request::input('executor_id')
                ,'project_name_ru' => Request::input('project_name_ru'),'economic' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('economic')),'description' => Request::input('description')]);

       if(Auth::user()->user_grant !=6 )
       {
           $project = DB::table('Project')
               ->where('project_id', Request::input('id'))
               ->update(['respondent_emp_id' => Request::input('respondent_emp_id')]);
       }

        $data= Request::input('id');
        $state = DB::select("select t.state_id as state from V_PROCESS t where t.process_id = (select max(v.process_id) from V_PROCESS v where v.project_id=".$data.")");
        $plan = DB::select("select plan from V_PROJECT t where t.project_id=".$data."");

        $budget = DB::select("select sum(t.budget) as totalbudget from V_PROCESS t where t.project_id=".$data."");
        if($plan[0]->plan != 0) {
            if ($budget[0]->totalbudget != NULL && $budget[0]->totalbudget != 0) {
                $percent = ($budget[0]->totalbudget / $plan[0]->plan) * 100;
                $process = DB::table('Project')
                    ->where('project_id', $data)
                    ->update(['budget' => $budget[0]->totalbudget, 'state_id' => $state[0]->state, 'percent' => $percent]);
            }
        }

        return Redirect('barilga');
    }
    public function approve(Request $request)
    {
        $project = DB::table('Project')
            ->where('project_id', Request::input('id'))
            ->update(['is_approved' =>1,'approved_date' =>Carbon::today(),'approved_id' =>Auth::user()->id]);
        activity()->performedOn($project)->log('Project approved');
        return Redirect('barilga');
    }
    public function destroy($id)
    {
        Project::where('project_id', '=', $id)->delete();
        Process::where('project_id', '=', $id)->delete();
        return Redirect('barilga');
    }
}
