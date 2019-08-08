<?php

namespace App\Http\Controllers;

use App\Projecttype;
use Illuminate\Support\Facades\Route;
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


          if(Route::getFacadeRoot()->current()->uri()== 'zaswar'){
              $sprojecttype=1;
          }

              if(Route::getFacadeRoot()->current()->uri()== 'barilga'){
                  $sprojecttype=2;
              }


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
        $stusuv = preg_replace('/[a-zZ-a,]/', '',Request::input('stusuv'));
        $stuluvluguu = preg_replace('/[a-zZ-a,]/', '',Request::input('stuluvluguu'));
        $sguitsetgel = preg_replace('/[a-zZ-a,]/', '',Request::input('sguitsetgel'));

        $startdate= Input::get('sdate1');
        $enddate = Input::get('sdate2');
        if (Auth::user()->dep_id == 22) {
            $query.="";

        }
        else
        {
            $query.=" and department_id = '".Auth::user()->dep_id."'";

        }
        if ($startdate !=0 && $startdate && $enddate !=0 && $enddate !=NULL) {
            $query.="and end_date between '".$startdate."' and '".$enddate." 23:59:59'";

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
        if ($sguitsetgel!=NULL && $sguitsetgel !=0) {
            $query.=" and budget = ".$sguitsetgel."";

        }
        else
        {
            $sstate_id=0;
            $query.=" ";

        }
        if ($stusuv!=NULL && $stusuv !=0) {
            $query.=" and estimation = ".$stusuv."";

        }
        else
        {

            $query.=" ";

        }
        if ($stuluvluguu!=NULL && $stuluvluguu !=0) {
            $query.=" and plan= ".$stuluvluguu."";

        }
        else
        {

            $query.=" ";

        }
        $gproject_id = 0;
        if( Session::has('gproject_id') ) {
            $gproject_id = Session::get('gproject_id');
        }

        $project =DB::select("select  * from V_PROJECT t  where 1=1 " .$query. " order by report_rowno, ex_report_no");
        return view('barilga')->with(['schildabbr'=>$schildabbr,'smethod_id'=>$smethod_id,'sstate_id'=>$sstate_id,'srespondent_emp_id'=>$srespondent_emp_id,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'sprojecttype'=>$sprojecttype,'gproject_id'=>$gproject_id,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'employee'=>$employee,
            'stusuv'=>$stusuv,'stuluvluguu'=>$stuluvluguu,'sguitsetgel'=>$sguitsetgel,  'method'=>$method,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype]);
    }
    public function store()
    {

        if(Request::input('proj')== 1){
            $sprojecttype=1;
        }

        if(Request::input('proj')==2){
            $sprojecttype=2;
        }
        $project = new Project;
        $project->plan_year = 2019;
        $project->project_name = Request::input('project_name');
        $project->project_name_ru = Request::input('project_name_ru');
        $project->budget =preg_replace('/[a-zZ-a,]/', '',Request::input('budget'));
        $project->contract =preg_replace('/[a-zZ-a,]/', '',Request::input('geree'));
        $project->contract_num =Request::input('gereenum');
        $project->estimation = preg_replace('/[a-zZ-a,]/', '',Request::input('estimation'));
        $project->plan = preg_replace('/[a-zZ-a,]/', '',Request::input('plan'));
        $project->plan1 = preg_replace('/[a-zZ-a,]/', '',Request::input('plan1'));
        $project->plan2 = preg_replace('/[a-zZ-a,]/', '',Request::input('plan2'));
        $project->plan3 = preg_replace('/[a-zZ-a,]/', '',Request::input('plan3'));
        $project->plan4 = preg_replace('/[a-zZ-a,]/', '',Request::input('plan4'));
        $project->department_id = Request::input('constructor_id');
        $project->project_type =$sprojecttype;
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
        $project->economic = preg_replace('/[a-zZ-a,]/', '',Request::input('economic'));
        $project->description = Request::input('description');
        $project->start_date = Request::input('date1');
        $project->end_date = Request::input('date2');
        $project->prstart_date = Request::input('prdate1');
        $project->prend_date = Request::input('prdate2');
        $project->save();

        activity()->performedOn($project)->log('Project added');
        if(Request::input('proj')== 1){
            return Redirect('zaswar');
        }

        if(Request::input('proj')== 2){
            return Redirect('barilga');
        }


    }

    public function update(Request $request)
    {

        $schildabbr= Input::get('schildabbr_id');
        $smethod_id= Input::get('smethod_id');
        $sstate_id= Input::get('sstate_id');
        $sexecutor = Input::get('sexecutor_id');
        $sconstructor = Input::get('sconstructor_id');
        $srespondent_emp_id = Input::get('srespondent_emp_id');
        $startdate= Input::get('sdate1');
        $enddate = Input::get('sdate2');
        $project = DB::table('Project')
            ->where('project_id', Request::input('id'))
            ->update(['project_name' => Request::input('project_name'),'project_name_ru' => Request::input('project_name_ru')
               , 'contract' =>preg_replace('/[a-zZ-a,]/', '',Request::input('geree')) ,'contract_num' =>Request::input('gereenum') ,'estimation' =>preg_replace('/[a-zZ-a,]/', '',Request::input('estimation')) ,
                'plan' => preg_replace('/[a-zZ-a,]/', '',Request::input('plan')),'department_id' => Request::input('constructor_id'),'department_child' => Request::input('childabbr_id')
                ,'plan1' => preg_replace('/[a-zZ-a,]/', '',Request::input('plan1')),'plan2' => preg_replace('/[a-zZ-a,]/', '',Request::input('plan2'))
                ,'plan3' => preg_replace('/[a-zZ-a,]/', '',Request::input('plan3')),'plan4' => preg_replace('/[a-zZ-a,]/', '',Request::input('plan4'))
                ,'project_type' => Request::input('project_type'),'start_date' => Request::input('date1'),'end_date' => Request::input('date2'),'prstart_date' => Request::input('prdate1')
                ,'method_code' => Request::input('method_code'),'percent' => Request::input('percent'),'executor_id' => Request::input('executor_id')
                ,'project_name_ru' => Request::input('project_name_ru'),'economic' => preg_replace('/[a-zZ-a,]/', '',Request::input('economic')),'description' => Request::input('description')]);

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
        $state = DB::select("select t.state_id as state from V_PROCESS t where t.process_id = (select max(v.process_id) from V_PROCESS v where v.project_id=".$data.")");
        $plan = DB::select("select plan from V_PROJECT t where t.project_id=".$data."");

        $budget = DB::select("select sum(t.budget) as totalbudget from V_PROCESS t where t.project_id=".$data."");
        $description = DB::select("select t.description as description from V_PROCESS t where t.process_id = (select max(v.process_id) from V_PROCESS v where v.project_id=".$data.")");

        if($plan != NULL ) {
            if ($plan[0]->plan != NULL) {
                $percent=($budget[0]->totalbudget / $plan[0]->plan)*100;
                $process = DB::table('Project')
                    ->where('project_id', $data)
                    ->update(['budget' => $budget[0]->totalbudget, 'percent' => $percent]);

            }

        }
        if($state != NULL) {
            $process = DB::table('Project')
                ->where('project_id', $data)
                ->update(['state_id' => $state[0]->state,'description' => $description[0]->description]);
        }
        if($state == NULL){
            $process = DB::table('Project')
                ->where('project_id', $data)
                ->update(['state_id' => 15]);
        }
        if($budget[0]->totalbudget == NULL) {
            $process = DB::table('Project')
                ->where('project_id', $data)
                ->update(['budget' => 0,'percent' => 0]);
        }


        if(Request::input('proj')== 1){
            return back()->withInput();
        }

        if(Request::input('proj')== 2){
            return back()->withInput();
        }


    }
    public function approve(Request $request)
    {
        $project = DB::table('Project')
            ->where('project_id', Request::input('id'))
            ->update(['is_approved' =>1,'approved_date' =>Carbon::today(),'approved_id' =>Auth::user()->id]);
        activity()->performedOn($project)->log('Project approved');
        if(Request::input('proj')== 1){
            return Redirect('zaswar');
        }

        if(Request::input('proj')== 2){
            return Redirect('barilga');
        }
    }
    public function destroy($id)
    {

        Project::where('project_id', '=', $id) ->update(['is_del' =>1]);
        if(Request::input('proj')== 1){
            return Redirect('zaswar');
        }

        if(Request::input('proj')== 2){
            return Redirect('barilga');
        }
    }
}
