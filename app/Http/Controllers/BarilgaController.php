<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Image;
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
use App\Season;
use App\Month;
use App\Process;
use App\State;
use App\Year;
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
        $month = Month::where('is_search', 1)->orderby('id')->get();
        $method = Method::orderby('method_name')->get();
        $year = Year::orderby('year_name')->get();
        $projecttype = Projecttype::orderby('project_type_name_mn')->get();
        $season = Season::orderby('season_id')->get();
        $constructor = Constructor::orderby('department_abbr')->get();
        $executor = DB::select("select * from V_EXECUTOR t order by report_rowno, ex_report_no");
        $employee =DB::select('select  * from V_CONST_EMPLOYEE t where t.is_engineer=1 order by firstname');
        $srespondent_emp_id = Input::get('srespondent_emp_id');
        $both_id = Input::get('both_id');
    
        if(Session::has('srespondent_emp_id')) {
            $srespondent_emp_id = Session::get('srespondent_emp_id');

        }
        else {
            Session::put('srespondent_emp_id', $srespondent_emp_id);
        }
        if(Session::has('both_id')) {
            $both_id = Session::get('both_id');

        }
        else {
            Session::put('both_id', $both_id);
        }
       
        $schildabbr= Input::get('schildabbr_id');
        if(Session::has('schildabbr_id')) {
            $schildabbr = Session::get('schildabbr_id');
        }
        else {
            Session::put('schildabbr_id', $schildabbr);
        }
        $smethod_id= Input::get('smethod_id');
        if(Session::has('smethod_id')) {
            $smethod_id = Session::get('smethod_id');
        }
        else {
            Session::put('smethod_id', $smethod_id);
        }
        $syear_id= Input::get('syear_id');
        if(Session::has('syear_id')) {
            $syear_id = Session::get('syear_id');
        }
        else {
            Session::put('syear_id', $syear_id);
        }
        $sstate_id= Input::get('sstate_id');

        if(Session::has('sstate_id')) {
            $sstate_id = Session::get('sstate_id');
        }
        else {
            Session::put('sstate_id', $sstate_id);
        }

        $sexecutor = Input::get('sexecutor_id');
        if(Session::has('sexecutor_id')) {
            $sexecutor = Session::get('sexecutor_id');
        }
        else {
            Session::put('sexecutor_id', $sexecutor);
        }
        $sconstructor = Input::get('sconstructor_id');
        if(Session::has('sconstructor')) {
            $sconstructor = Session::get('sconstructor');
        }
        else {
            Session::put('sconstructor', $sconstructor);
        }


        $stusuv = preg_replace('/[a-zZ-a,]/', '',Request::input('stusuv'));
        $stuluvluguu = preg_replace('/[a-zZ-a,]/', '',Request::input('stuluvluguu'));
        $sguitsetgel = preg_replace('/[a-zZ-a,]/', '',Request::input('sguitsetgel'));

        $startdate= Input::get('sdate1');
        $enddate = Input::get('sdate2');
        if (Auth::user()->dep_id == 55) {
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
            $type =DB::select('select t.executor_type from V_EXECUTOR t where t.executor_id =  '. $sexecutor.'');
            if ($type[0]->executor_type ==1){
                $dep =DB::select('select t.department_id from V_EXECUTOR t where t.executor_id =  '. $sexecutor.'');

                $query.=" and executor_id in (select executor_id from CONST_EXECUTOR t where t.executor_par='".$dep[0]->department_id."')";
            }
            else{
                $query.=" and executor_id = '".$sexecutor."'";
            }
        }
        else
        {
            $sexecutor=0;
            $query.=" ";

            
        }
  
        if ($both_id!=NULL && $both_id !=0) {
            $type =DB::select('select t.executor_type from V_EXECUTOR t where t.executor_id =  '. $both_id.'');
            $dep =DB::select('select t.department_id from V_EXECUTOR t where t.executor_id =  '. $both_id.'');

            if ($type[0]->executor_type ==1){
                $query.=" and (department_id = '".$dep[0]->department_id."' or executor_id in (select executor_id from CONST_EXECUTOR t
                where t.executor_par='".$dep[0]->department_id."'))";
            }  
            else{
               
                $query.=" and (department_child = '".$both_id."' or executor_id ='".$both_id."') ";
               
            }
           
        }
        else
        {
            $query.=" ";

        }
        if ($syear_id!=NULL && $syear_id !=0) {
            $query.=" and plan_year = '".$syear_id."'";

        }
        else
        {
            $syear_id=2022;
            $query.="and plan_year = 2022";

        }
        if ($schildabbr!=NULL && $schildabbr !=0) {
            $type =DB::select('select t.executor_type from V_EXECUTOR t where t.executor_id =  '. $schildabbr.'');
            if ($type[0]->executor_type ==1){
                $dep =DB::select('select t.department_id from V_EXECUTOR t where t.executor_id =  '. $schildabbr.'');

                $query.=" and department_id = '".$dep[0]->department_id."'";
            }
            else{
                $query.=" and department_child = '".$schildabbr."'";
            }
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
            $query.=" ";

        }
        if ($sstate_id!=NULL && $sstate_id !=0) {
            if($sstate_id == 99){
                $query.=" and state_id in (8,42,41,9,11,12,10,14,7)";
            }
            else{
                $query.=" and state_id = '".$sstate_id."'";
            }


        }
        else
        {
            $sstate_id=0;
            $query.=" ";

        }
        if ($sguitsetgel!=NULL) {
            $query.=" and budget = ".$sguitsetgel."";

        }
        else
        {
            $sguitsetgel=0;
            $query.=" ";

        }
        if ($stusuv!=NULL) {
            $query.=" and estimation = ".$stusuv."";

        }
        else
        {

            $query.=" ";

        }
        if ($stuluvluguu!=NULL) {
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

        $project =DB::select("select  * from V_PROJECT t  where 1=1 " .$query. " order by report_rowno, ex_report_no, project_id");
    
        return view('barilga')->with(['both_id'=>$both_id,'month'=>$month,'schildabbr'=>$schildabbr,'smethod_id'=>$smethod_id,'sstate_id'=>$sstate_id,'srespondent_emp_id'=>$srespondent_emp_id,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'sprojecttype'=>$sprojecttype,'gproject_id'=>$gproject_id,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'employee'=>$employee,
            'stusuv'=>$stusuv,'syear_id'=>$syear_id,'year'=>$year,'stuluvluguu'=>$stuluvluguu,'sguitsetgel'=>$sguitsetgel,  'method'=>$method,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype,'season'=>$season]);
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
        $project->plan_year = 2022;
        $project->project_name = Request::input('project_name');
        $project->project_name_ru = Request::input('project_name_ru');
        $project->budget =preg_replace('/[a-zZ-a,]/', '',Request::input('budget'));
        $project->contract =preg_replace('/[a-zZ-a,]/', '',Request::input('geree'));
        $project->contract_num =Request::input('gereenum');
        $project->estimation = preg_replace('/[a-zZ-a,]/', '',Request::input('estimation'));
        $project->plan = preg_replace('/[a-zZ-a,]/', '',Request::input('plan1')) + preg_replace('/[a-zZ-a,]/', '',Request::input('plan2')) + preg_replace('/[a-zZ-a,]/', '',Request::input('plan3')) + preg_replace('/[a-zZ-a,]/', '',Request::input('plan4'));
        $project->plan1 = preg_replace('/[a-zZ-a,]/', '',Request::input('plan1'));
        $project->plan2 = preg_replace('/[a-zZ-a,]/', '',Request::input('plan2'));
        $project->plan3 = preg_replace('/[a-zZ-a,]/', '',Request::input('plan3'));
        $project->plan4 = preg_replace('/[a-zZ-a,]/', '',Request::input('plan4'));
        $project->department_child = Request::input('childabbr_id');
        if (Request::input('childabbr_id')!=NULL && Request::input('childabbr_id') !=0) {
                $dep =DB::select('select t.department_id from V_EXECUTOR t where t.executor_id =  '. Request::input('childabbr_id').'');

                $project->department_id = $dep[0]->department_id;
            }

        $project->project_type =$sprojecttype;
        if (Request::input('respondent_emp_id')!=NULL && Request::input('respondent_emp_id') !=0) {

            $project->respondent_emp_id = Request::input('respondent_emp_id');
        }
        else{

            $project->respondent_emp_id =999;
        }

        $project->state_id = 16;
        $project->method_code = Request::input('method_code');
        $project->planseason = Request::input('season');
        $project->percent = Request::input('percent');
        $project->executor_id = Request::input('executor_id');
        $project->added_user_id = Auth::user()->id;
        $project->project_name_ru = Request::input('project_name_ru');
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
        $srespondent_emp_id = Input::get('srespondent_emp_id');
        $startdate= Input::get('sdate1');
        $enddate = Input::get('sdate2');

        if (Request::input('childabbr_id')!=NULL && Request::input('childabbr_id') !=0) {
            $dep =DB::select('select t.department_id from V_EXECUTOR t where t.executor_id =  '. Request::input('childabbr_id').'');

            $project = DB::table('Project')
                ->where('project_id', Request::input('id'))
                ->update(['department_id' => $dep[0]->department_id,'department_child' => Request::input('childabbr_id')]);
        }

        $project = DB::table('Project')
            ->where('project_id', Request::input('id'))->where('is_lock',0)
            ->update(['project_name' => Request::input('project_name'),'project_name_ru' => Request::input('project_name_ru')
               , 'contract' =>preg_replace('/[a-zZ-a,]/', '',Request::input('geree')) ,'contract_num' =>Request::input('gereenum') ,'estimation' =>preg_replace('/[a-zZ-a,]/', '',Request::input('estimation')) ,
                'plan' => (preg_replace('/[a-zZ-a,]/', '',Request::input('plan1')) + preg_replace('/[a-zZ-a,]/', '',Request::input('plan2')) + preg_replace('/[a-zZ-a,]/', '',Request::input('plan3')) + preg_replace('/[a-zZ-a,]/', '',Request::input('plan4')))
                ,'plan1' => preg_replace('/[a-zZ-a,]/', '',Request::input('plan1')),'plan2' => preg_replace('/[a-zZ-a,]/', '',Request::input('plan2'))
                ,'plan3' => preg_replace('/[a-zZ-a,]/', '',Request::input('plan3')),'plan4' => preg_replace('/[a-zZ-a,]/', '',Request::input('plan4'))
                ,'start_date' => Request::input('date1'),'end_date' => Request::input('date2'),'prstart_date' => Request::input('prdate1')
                ,'method_code' => Request::input('method_code'),'planseason' => Request::input('season'),'percent' => Request::input('percent'),'executor_id' => Request::input('executor_id')
                ,'project_name_ru' => Request::input('project_name_ru'),'description' => Request::input('description')]);

       if(Auth::user()->user_grant !=6 )
       {
           $project = DB::table('Project')
               ->where('project_id', Request::input('id'))->where('is_lock',0)
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
                    ->where('project_id', $data)->where('is_lock',0)
                    ->update(['budget' => $budget[0]->totalbudget, 'percent' => $percent]);

            }

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
            ->where('project_id', Request::input('id'))->where('is_lock',0)
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
    public function saveimg(Request $request)
    {
        $data= Request::input('pr_id');
        if (Request::hasFile('img_1')) {
            $photo = Input::file('img_1');
          
                $file = Input::file('img_1');
              
                $filenamewithextension = $photo->getClientOriginalName();
                
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $photo->getClientOriginalExtension();
      
                $size = $photo->getSize();
                //filename to store

                $filenametostore = date('YmdHisu') . '_1' . '.' . $extension;

                Storage::put('profile_images/img/' . $filenametostore, fopen($photo, 'r+'));
                //Resize image here
              
                $imgpath = public_path('profile_images/img/' . $filenametostore);
                $img = Image::make($photo->getRealPath())->resize(2500, 1500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imgpath);
                $project = DB::table('Project')
                ->where('project_id', $data)->where('is_lock',0)
                ->update(['img_1' =>$filenametostore]);
           
        }
        if (Request::hasFile('img_2')) {
            $photo = Input::file('img_2');
          
                $file = Input::file('img_2');
              
                $filenamewithextension = $photo->getClientOriginalName();
                
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $photo->getClientOriginalExtension();
      
                $size = $photo->getSize();
                //filename to store

                $filenametostore = date('YmdHisu') . '_2' . '.' . $extension;

                Storage::put('profile_images/img/' . $filenametostore, fopen($photo, 'r+'));
                //Resize image here
              
                $imgpath = public_path('profile_images/img/' . $filenametostore);
                $img = Image::make($photo->getRealPath())->resize(2500, 1500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imgpath);
                $project = DB::table('Project')
                ->where('project_id', $data)->where('is_lock',0)
                ->update(['img_2' =>$filenametostore]);

        }
        if (Request::hasFile('img_3')) {
            $photo = Input::file('img_3');
          
                $file = Input::file('img_3');
              
                $filenamewithextension = $photo->getClientOriginalName();
                
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $photo->getClientOriginalExtension();
      
                $size = $photo->getSize();
                //filename to store

                $filenametostore = date('YmdHisu') . '_3' . '.' . $extension;

                Storage::put('profile_images/img/' . $filenametostore, fopen($photo, 'r+'));
                //Resize image here
              
                $imgpath = public_path('profile_images/img/' . $filenametostore);
                $img = Image::make($photo->getRealPath())->resize(2500, 1500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imgpath);
                $project = DB::table('Project')
                ->where('project_id', $data)->where('is_lock',0)
                ->update(['img_3' =>$filenametostore]);

        }
        if (Request::hasFile('img_4')) {
            $photo = Input::file('img_4');
          
                $file = Input::file('img_4');
              
                $filenamewithextension = $photo->getClientOriginalName();
                
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $photo->getClientOriginalExtension();
      
                $size = $photo->getSize();
                //filename to store

                $filenametostore = date('YmdHisu') . '_4' . '.' . $extension;

                Storage::put('profile_images/img/' . $filenametostore, fopen($photo, 'r+'));
                //Resize image here
              
                $imgpath = public_path('profile_images/img/' . $filenametostore);
                $img = Image::make($photo->getRealPath())->resize(2500, 1500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imgpath);
                $project = DB::table('Project')
                ->where('project_id', $data)->where('is_lock',0)
                ->update(['img_4' =>$filenametostore]);

        }
        return back();
      
    }

    public function filter_resp($srespondent_emp_id) {
        Session::put('srespondent_emp_id',$srespondent_emp_id);
        return back();
    }
    public function filter_method($smethod_id) {
        Session::put('smethod_id',$smethod_id);
        return back();
    }
    public function filter_state($sstate_id) {

        Session::put('sstate_id',$sstate_id);

        return back();
    }
    public function filter_childabbr($schildabbr_id) {
        Session::put('schildabbr_id',$schildabbr_id);
        return back();
    }
    public function filter_executor($sexecutor_id) {
        Session::put('sexecutor_id',$sexecutor_id);
        return back();
    }
    public function filter_year($syear_id) {
        Session::put('syear_id',$syear_id);
        return back();
    }
    public function filter_month($month) {
        Session::put('month',$month);
        return back();
    }
    public function filter_season($season) {
        Session::put('season',$season);
        return back();
    }
    public function filter_both($both_id) {
        Session::put('both_id',$both_id);
        return back();
    }
}
