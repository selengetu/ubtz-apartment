<?php

namespace App\Http\Controllers;

use App\ProcessImage;
use App\Projecttype;
use Request;
use Session;
use App\Constructor;
use App\Executor;
use App\Employee;
use App\Project;
use App\Method;
use App\State;
use App\Year;
use App\Month;
use DB;
use PDF;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
class TailanController extends Controller
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
        if(Route::getFacadeRoot()->current()->uri()== 'main'){
            $sprojecttype=1;
        }

        if(Route::getFacadeRoot()->current()->uri()== 'mainib'){
            $sprojecttype=2;
        }

        $date = "";
        $date1 = "";
        $query = "";
        $mo = Month::orderby('id')->get();
        $year = Year::orderby('year_name')->get();
        $state = State::orderby('state_name_mn')->get();
        $method = Method::orderby('method_name')->get();
        $projecttype = Projecttype::orderby('project_type_name_mn')->get();
        $constructor = Constructor::orderby('department_abbr')->get();
        $nz = DB::table('CONST_NZ')->orderby('nz_id')->get();
        $executor = DB::select("select * from V_EXECUTOR");
        $month = Input::get('month');
        $employee =DB::select('select  * from V_CONST_EMPLOYEE t where t.is_engineer=1 order by firstname');
        $schildabbr= Input::get('schildabbr_id');
        $sstate_id= Input::get('sstate_id');
        $sexecutor = Input::get('sexecutor_id');
        $sconstructor = Input::get('sconstructor_id');
        $srespondent_emp_id = Input::get('srespondent_emp_id');
        $startdate= Input::get('date1');
        $enddate = Input::get('date2');
        $syear_id= Input::get('syear_id');
        $nz_id= Input::get('nz_id');
        $both_id = Input::get('both_id');
        if(Session::has('month')) {
            $month = Session::get('month');
        }
        else {
            Session::put('month', $month);
        }
        if(Session::has('syear_id')) {
            $syear_id = Session::get('syear_id');
        }
        else {
            Session::put('syear_id', $syear_id);
        }
        if (Auth::user()->dep_id == 55 or Auth::user()->dep_id == 99) {
            $query.="";

        }
        else
        {
            if(Auth::user()->user_grant == 9) {
                $query.=" and (department_child = '".Auth::user()->dep_id."' or executor_id ='".Auth::user()->dep_id."') ";
    
            }  
            else{
                $query.=" and (department_id = '".Auth::user()->dep_id."' or executor_id in (select executor_id from CONST_EXECUTOR t
                where t.executor_par='".Auth::user()->dep_id."'))";
            }

        }
        if(Session::has('both_id')) {
            $both_id = Session::get('both_id');

        }
        else {
            Session::put('both_id', $both_id);
        }
        if ($startdate !=0 && $startdate && $enddate !=0 && $enddate !=0-NULL) {
            $query.=" where start_date between '".$startdate."' and '".$enddate." 23:59:59'";

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
            $syear_id=2021;
            $query.="and plan_year = 2021 ";

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
            $query.=" ";

        }
        if ($sconstructor!=NULL && $sconstructor !=0) {
            $query.=" and department_id = '".$sconstructor."'";

        }
        else
        {
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
            $query.=" ";

        }
        if ($srespondent_emp_id!=NULL && $srespondent_emp_id !=0) {
            $query.=" and respondent_emp_id = '".$srespondent_emp_id."'";

        }
        else
        {
            $query.=" ";

        }if ($nz_id!=NULL && $nz_id !=0) {
            $query.=" and department_id in (".$nz_id.")";

        }
        else
        {
            $query.=" ";

        }
        if ($month!=NULL && $month !=0) {
            $date.=" and month <= ".$month."";
            $date1.=" and par.month =".$month."";

        }
        else
        {
            $month =Carbon::now()->format('m');
            $date.=" and month <= ".$month."";
            $date1.=" and par.month =".$month."";


        }
        $gproject_id = 0;
        if( Session::has('gproject_id') ) {
            $gproject_id = Session::get('gproject_id');
        }

        $data= Request::input('gproject_id');
        $project =DB::select("select u.project_id,
       u.plan_year,
       u.project_name,
       u.project_name_ru
       ,
        to_char( u.budget,'999,999,999,999') as budgetcomma,
       u.budget,
       par.budget as bud,
       par.runningtotal,
       par.month,
       par.diff,
        to_char(u.estimation,'999,999,999,999') as estimationcomma,
       u.estimation,
        to_char(u.plan,'999,999,999,999') as plancomma,
       u.plan,
        u.economic,
         to_char(u.economic,'999,999,999,999') as economiccomma,
       u.department_id,
       u.department_name,
       u.department_type,
       u.season_name,
       u.img_1,
       u.plan1,
       u.plan2,
       u.plan3,
       u.plan4,
       u.project_type,
       u.project_type_name_mn,
       u.added_user_id,
         u.childabbr,
         u.executor_type,
       u.name,
       u.fletter,
       u.respondent_emp_id,
       u.firstname   ,
      u.state_id,
       u.state_name_mn,
       u.state_name_ru,
       u.state_bk_color, 
       u.state_tx_color,
       u.method_code,
       u.method_name,
       u.percent,
       u.executor_id,
       u.executor_abbr,
       u.project_name_ru,
       u.start_date,
       u.end_date,
       u.description,
       u.report_rowno,
       u.prend_date
       from
       v_project u,

(
select q.project_id , q.month, q.budget,  SUM(q.budget) OVER (PARTITION BY q.project_id ORDER BY Month) AS RunningTotal,( SUM(q.budget) OVER (PARTITION BY q.project_id ORDER BY Month) )- q.budget as diff
from 
(select project_id , month, sum (budget) budget
from 
(
select t.project_id , t.month, t.budget
from PROJECT_PROCESS t 
union all    
select t.project_id , m.id month , 0 budget
from V_PROJECT t , CONST_MONTH m 
order by project_id, month
)
group by project_id, month
order by project_id, month) q
order by q.project_id, q.month ) par
where  par.project_id=u.project_id ".$date1." ".$query." 
order by report_rowno, ex_report_no, xex_report_no, project_id");

        return view('tailan.main')->with(['both_id'=>$both_id,'mo'=>$mo,'nz'=>$nz,'month'=>$month,'syear_id'=>$syear_id,'year'=>$year,'gproject_id'=>$gproject_id,'data'=>$data,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'syear_id'=>$syear_id,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype,'sprojecttype'=>$sprojecttype]);
    }
    public function season()
    {
        if(Route::getFacadeRoot()->current()->uri()== 'seasoniz'){
            $sprojecttype=1;
        }

        if(Route::getFacadeRoot()->current()->uri()== 'seasonib'){
            $sprojecttype=2;
        }

        $query = "";
        $date = "";
        $seasons = DB::select('select * from CONST_REPORT_SEASON');
        $year = Year::orderby('year_name')->get();
        $state = State::orderby('state_name_mn')->get();
        $method = Method::orderby('method_name')->get();
        $projecttype = Projecttype::orderby('project_type_name_mn')->get();
        $constructor = Constructor::orderby('department_abbr')->get();
        $nz = DB::table('CONST_NZ')->orderby('nz_id')->get();
        $executor = DB::select("select * from V_EXECUTOR");
        $season = Input::get('season');
       
        $employee =DB::select('select  * from V_CONST_EMPLOYEE t where t.is_engineer=1 order by firstname');
        $schildabbr= Input::get('schildabbr_id');
        $sstate_id= Input::get('sstate_id');
        $sexecutor = Input::get('sexecutor_id');
        $sconstructor = Input::get('sconstructor_id');
        $srespondent_emp_id = Input::get('srespondent_emp_id');
        $startdate= Input::get('date1');
        $enddate = Input::get('date2');
        $syear_id= Input::get('syear_id');
        $nz_id= Input::get('nz_id');
        $both_id = Input::get('both_id');
        if(Session::has('season')) {
            $season = Session::get('season');
        }
        else {
            if ($season ==NULL) {
                $season="1";
                Session::put('season', $season);
            }
            else{
                Session::put('season', $season);
            }
          
        }
        
        $s =DB::select('select t.season_plan, season_process from CONST_REPORT_SEASON t where t.season_id =  '. $season.'');

        if ($s[0]->season_plan!=NULL) {
            $date.=" (".$s[0]->season_plan.") as vplan";

        }
        else
        {
            $date.="plan1 as vplan";
        }
    
        if(Session::has('syear_id')) {
            $syear_id = Session::get('syear_id');
        }
        else {
            Session::put('syear_id', $syear_id);
        }
        
        if (Auth::user()->dep_id == 55 or Auth::user()->dep_id == 99) {
            $query.="";
        }
        else
        {
            if(Auth::user()->user_grant == 9) {
                $query.=" and (department_child = '".Auth::user()->dep_id."' or executor_id ='".Auth::user()->dep_id."') ";
    
            }  
            else{
                $query.=" and (department_id = '".Auth::user()->dep_id."' or executor_id in (select executor_id from CONST_EXECUTOR t
                where t.executor_par='".Auth::user()->dep_id."'))";
            }

        }
        if(Session::has('both_id')) {
            $both_id = Session::get('both_id');

        }
        else {
            Session::put('both_id', $both_id);
        }
        if ($startdate !=0 && $startdate && $enddate !=0 && $enddate !=0-NULL) {
            $query.=" where start_date between '".$startdate."' and '".$enddate." 23:59:59'";

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
            $syear_id=2021;
            $query.="and plan_year = 2021 ";

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
            $query.=" ";

        }
        if ($sconstructor!=NULL && $sconstructor !=0) {
            $query.=" and department_id = '".$sconstructor."'";

        }
        else
        {
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
            $query.=" ";

        }
        if ($srespondent_emp_id!=NULL && $srespondent_emp_id !=0) {
            $query.=" and respondent_emp_id = '".$srespondent_emp_id."'";

        }
        else
        {
            $query.=" ";

        }
       
        $gproject_id = 0;
        if( Session::has('gproject_id') ) {
            $gproject_id = Session::get('gproject_id');
                    }

                    $data= Request::input('gproject_id');
                    $project =DB::select("select v.*, 
                    $date,
                    b.qbudget
                    from V_PROJECT v, 
            
            (select project_id, sum(q.budget) as qbudget
            from
            (select project_id , month, sum (budget) budget
            from 
            (
            select t.project_id , t.month, t.budget
            from PROJECT_PROCESS t 
            union all    
            select t.project_id , m.id month , 0 budget
            from V_PROJECT t , CONST_MONTH m 
            order by project_id, month
            )
            group by project_id, month
            order by project_id, month) q
            where q.month in (".$s[0]->season_process." )
            group by project_id) b
            where b.project_id=v.project_id ".$query." ");

        return view('tailan.season')->with(['both_id'=>$both_id,'seasons'=>$seasons,'season'=>$season,'nz'=>$nz,'syear_id'=>$syear_id,'year'=>$year,'gproject_id'=>$gproject_id,'data'=>$data,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'syear_id'=>$syear_id,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype,'sprojecttype'=>$sprojecttype]);
    }
    public function time()
    {
        $query = "";
        $state = State::orderby('state_name_mn')->get();
        $method = Method::orderby('method_name')->get();
        $projecttype = Projecttype::orderby('project_type_name_mn')->get();
        $constructor = Constructor::orderby('department_abbr')->get();
        $executor = DB::select("select * from V_EXECUTOR t, CONST_DEPARTMENT d where t.executor_par = d.department_id order by t.executor_par ,t.executor_type,t.executor_abbr");

        $employee =DB::select('select  * from V_CONST_EMPLOYEE t where t.is_engineer=1 order by firstname');

        $sstate_id= Input::get('sstate_id');
        $sexecutor = Input::get('sexecutor_id');
        $sconstructor = Input::get('sconstructor_id');
        $srespondent_emp_id = Input::get('srespondent_emp_id');
        $sprojecttype= Input::get('sproject_type');
        $startdate= Input::get('date1');
        $enddate = Input::get('date2');
        $syear_id= Input::get('syear_id');
        $year = Year::orderby('year_name')->get();
        if (Auth::user()->dep_id == 55 or Auth::user()->dep_id == 99 ) {
            $query.="";

        }
        else
        {
            if(Auth::user()->user_grant == 9) {
                $query.=" and department_child = '".Auth::user()->dep_id."' or executor_id ='".Auth::user()->dep_id."' ";
    
            }  
            else{
                $query.=" and department_id = '".Auth::user()->dep_id."'";
            }
           

        }
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
            $type =DB::select('select t.executor_type from V_EXECUTOR t where t.executor_id =  '. $sexecutor.'');
            if ($type[0]->executor_type ==1){
                $dep =DB::select('select t.department_id from V_EXECUTOR t where t.executor_id =  '. $sexecutor.'');

                $query.=" and department_id = '".$dep[0]->department_id."'";
            }
            else{
                $query.=" and department_child = '".$sexecutor."'";
            }
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

        if ($srespondent_emp_id!=NULL && $srespondent_emp_id !=0) {
            $query.=" and respondent_emp_id = '".$srespondent_emp_id."'";

        }
        else
        {
            $srespondent_emp_id=0;
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
        $gproject_id = 0;
        if( Session::has('gproject_id') ) {
            $gproject_id = Session::get('gproject_id');
        }
        $data= Request::input('gproject_id');
        $project =DB::select("select  * from V_PROJECT t  where 1=1 " .$query. " order by project_id");
        return view('tailan.time')->with(['sstate_id'=>$sstate_id,'syear_id'=>$syear_id,'year'=>$year,'srespondent_emp_id'=>$srespondent_emp_id,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'sprojecttype'=>$sprojecttype,'gproject_id'=>$gproject_id,'data'=>$data,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype]);
    }
    public function geree()
    {
        $query = "";
        $state = State::orderby('state_name_mn')->get();
        $method = Method::orderby('method_name')->get();
        $projecttype = Projecttype::orderby('project_type_name_mn')->get();
        $constructor = Constructor::orderby('department_abbr')->get();
        $executor = DB::select("select * from V_EXECUTOR t");
        $employee =DB::select('select  * from V_CONST_EMPLOYEE t where t.is_engineer=1 order by firstname');
        $sstate_id= Input::get('sstate_id');
        $sexecutor = Input::get('sexecutor_id');
        $schildabbr = Input::get('schildabbr_id');
        $srespondent_emp_id = Input::get('srespondent_emp_id');
        $sprojecttype= Input::get('sproject_type');
        $startdate= Input::get('date1');
        $enddate = Input::get('date2');
        $syear_id= Input::get('syear_id');
        $year = Year::orderby('year_name')->get();
        if(Session::has('syear_id')) {
            $syear_id = Session::get('syear_id');
        }
        else {
            Session::put('syear_id', $syear_id);
        }
        if ($syear_id!=NULL && $syear_id !=0) {
            $query.=" and plan_year = '".$syear_id."'";

        }
        else
        {
            $syear_id=2021;
            $query.="and plan_year =2021 ";

        }
        if (Auth::user()->dep_id == 55 or Auth::user()->dep_id == 99 ) {
            $query.="";

        }
        else
        {
            if(Auth::user()->user_grant == 9) {
                $query.=" and department_child = '".Auth::user()->dep_id."' or executor_id ='".Auth::user()->dep_id."' ";
    
            }  
            else{
                $query.=" and department_id = '".Auth::user()->dep_id."'";
            }

        }
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
            $type =DB::select('select t.executor_type from V_EXECUTOR t where t.executor_id =  '. $sexecutor.'');
            if ($type[0]->executor_type ==1){
                $dep =DB::select('select t.department_id from V_EXECUTOR t where t.executor_id =  '. $sexecutor.'');

                $query.=" and department_id = '".$dep[0]->department_id."'";
            }
            else{
                $query.=" and department_child = '".$sexecutor."'";
            }
        }
        else
        {
            $sexecutor=0;
            $query.=" ";

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
        $data= Request::input('gproject_id');
        $project =DB::select("select  * from V_PROJECT t  where 1=1 and t.method_code=3 " .$query. " order by report_rowno, ex_report_no");
        return view('tailan.geree')->with(['year'=>$year,'syear_id'=>$syear_id,'sstate_id'=>$sstate_id,'srespondent_emp_id'=>$srespondent_emp_id,'schildabbr'=>$schildabbr,'sexecutor'=>$sexecutor,'sprojecttype'=>$sprojecttype,'gproject_id'=>$gproject_id,'data'=>$data,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'sexecutor'=>$sexecutor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype]);
    }

    public function analyse()
    {

        if(Route::getFacadeRoot()->current()->uri()== 'analyseib'){
            $sprojecttype=2;
        }

        if(Route::getFacadeRoot()->current()->uri()== 'analyseiz'){
            $sprojecttype=1;
        }
        $query = "";
        $state = State::orderby('state_name_mn')->get();
        $method = Method::orderby('method_name')->get();
        $projecttype = Projecttype::orderby('project_type_name_mn')->get();
        $constructor = Constructor::orderby('department_abbr')->get();
        $executor = Executor::orderby('executor_abbr')->get();

        $employee =DB::select('select  * from V_CONST_EMPLOYEE t where t.is_engineer=1 order by firstname');
        $syear_id= Input::get('syear_id');
        $month= Input::get('month');
        $year = Year::orderby('year_name')->get();
        if(Session::has('syear_id')) {
            $syear_id = Session::get('syear_id');
        }
        else {
            Session::put('syear_id', $syear_id);
        }
        if(Session::has('month')) {
            $month = Session::get('month');
        }
        else {
            Session::put('month', $month);
        }
        if ($syear_id!=NULL && $syear_id !=0) {
            $query.=" and plan_year = '".$syear_id."'";

        }
        else
        {
            $syear_id=2021;
            $query.="and plan_year =2021 ";

        }
        if ($month!=NULL && $month !=0) {
            $query.=" and month = '".$month."'";

        }
        else
        {
            $month=Carbon::now()->month;
            $query.="and month =".$month."";

        }


        if ($sprojecttype!=NULL && $sprojecttype !=0) {
            $query.=" and project_type = ".$sprojecttype."";

        }
        else
        {
            $query.=" ";

        }

        $t =DB::select("select 
        u.plan_year,
        par.month,
        u.department_id,
        u.department_name,
        u.department_type,
        u.project_type,
        u.report_rowno,
        to_char(  sum(u.budget),'999,999,999,999') as budgetcomma,
        sum(u.budget) as budget,
        to_char(  sum(par.budget),'999,999,999,999') as budcomma,
        sum(par.budget) as bud,
        to_char(  sum(par.runningtotal),'999,999,999,999') as runningtotalcomma,
        sum(par.runningtotal) as runningtotal,
        to_char(  sum(par.diff),'999,999,999,999') as diffcomma,
        sum(par.diff) as diff,
        to_char(  sum(u.estimation),'999,999,999,999') as estimationcomma,
        sum(u.estimation) as estimation,
        to_char(  sum(u.plan),'999,999,999,999') as plancomma,
        sum(u.plan) as plan,
        to_char(  sum(u.economic),'999,999,999,999') as economiccomma,
        sum(u.economic) as economic,
        (sum(par.runningtotal)/sum(u.plan))*100 as percent, 
        count(u.project_id) as ajliintoo,
    sum( u.plan1) as plan1,
        sum( u.plan2) as plan2,
        sum( u.plan3) as plan3,
        sum( u.plan4) as plan4,
        round((sum(u.percent)/count(u.percent)),2) as rpercent
        from
        v_project u,

            (
            select q.project_id , q.month, q.budget,  SUM(q.budget) OVER (PARTITION BY q.project_id ORDER BY Month) AS RunningTotal,( SUM(q.budget) OVER (PARTITION BY q.project_id ORDER BY Month) )- q.budget as diff
            from 
            (select project_id , month, sum (budget) budget
            from 
            (
            select t.project_id , t.month, t.budget
            from PROJECT_PROCESS t 
            union all    
            select t.project_id , m.id month , 0 budget
            from V_PROJECT t , CONST_MONTH m 
            order by project_id, month
            )
                group by project_id, month
                order by project_id, month) q
                order by q.project_id, q.month ) par
                where par.project_id=u.project_id ".$query."
                group by u.plan_year,
                        par.month,
                        u.department_id,
                        u.department_name,
                        u.department_type,
                        u.project_type,
                        u.report_rowno
                        
                order by report_rowno");
                $mo = Month::orderby('id')->get();
                        $project =DB::select("select  * from V_PROJECT t  order by project_id");
       
                 return view('tailan.analyse')->with(['t'=>$t,'month'=>$month,'mo'=>$mo,'method'=>$method,'constructor'=>$constructor,'syear_id'=>$syear_id,'year'=>$year,'executor'=>$executor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype,'sprojecttype'=>$sprojecttype]);


    }
    public function detail()
    {

        if(Route::getFacadeRoot()->current()->uri()== 'detailib'){
            $sprojecttype=2;
        }

        if(Route::getFacadeRoot()->current()->uri()== 'detailiz'){
            $sprojecttype=1;
        }
        $query = "";
        $state = State::orderby('state_name_mn')->get();
        $method = Method::orderby('method_name')->get();
        $projecttype = Projecttype::orderby('project_type_name_mn')->get();
        $constructor = Constructor::orderby('department_abbr')->get();
        $executor = Executor::orderby('executor_abbr')->get();

        $employee =DB::select('select  * from V_CONST_EMPLOYEE t where t.is_engineer=1 order by firstname');
        $startdate= Input::get('sdate1');
        $enddate = Input::get('sdate2');
        $syear_id= Input::get('syear_id');
        $year = Year::orderby('year_name')->get();
        if(Session::has('syear_id')) {
            $syear_id = Session::get('syear_id');
        }
        else {
            Session::put('syear_id', $syear_id);
        }
        if ($syear_id!=NULL && $syear_id !=0) {
            $query.=" and plan_year = '".$syear_id."'";

        }
        else
        {
            $syear_id=2021;
            $query.="and plan_year =2021 ";

        }
        if ($startdate !=0 && $startdate && $enddate !=0 && $enddate !=NULL) {
            $query.="and end_date between '".$startdate."' and '".$enddate." 23:59:59'";

        }
        else
        {
            $query.=" ";

        }


        if ($sprojecttype!=NULL && $sprojecttype !=0) {
            $query.=" and project_type = ".$sprojecttype."";

        }
        else
        {
            $query.=" ";

        }
        $t= DB::select("select b.* ,q.* ,(q.eune+q.egeree+ezurag+etusuv+emater+esanh+eguits+etusuv+ealba+esalbar+etul) as ehleegui 
        from (select d.executor_abbr as department_name, t.department_id,d.executor_type as department_type, t.report_rowno ,sum(t.plan) as plan, sum(t.budget) as budget, sum(t.estimation) as estimation, (sum(t.budget)/sum(t.plan))*100 as percent, sum(t.budget)-sum(t.plan) as diff, (sum(t.percent)/count(percent)) as rpercent , count(t.project_id) as ajliintoo 
        from V_PROJECT t , CONST_EXECUTOR d where t.department_id=d.executor_id  ".$query. "
        and t.state_id!=61 
        group by d.executor_type,t.department_id, d.executor_abbr, t.report_rowno
        order by t.report_rowno) b 
        inner join (SELECT * FROM ( SELECT department_id ,state_id 
        FROM v_project where 1=1  ".$query. " and state_id!=61 ) 
        PIVOT (count(state_id) 
        FOR state_id IN (1 as haasan,2 as duussan ,3 as gdag,4 as ghots,5 as gadgeree ,6 as nem,7 as eune,8 as egeree,9 as ezurag,10 as etul,11 as emater,12 as esanh ,13 as eguits ,14 as etusuv,16 as boloogui, 41 as ealba, 42 as esalbar, 81 as duus, 101 as yam ,102 as tender, 103 as tendersuc) ) ORDER BY department_id) q 
        on q.department_id=b.department_id
        order by report_rowno");
        $t2= DB::select("select state_name_ru , state_name_mn ,count(project_name) as niit 
                            from v_project t 
                            where t.state_id in (1,2,3,4,5,6,81,101,102,103) ".$query. "
                            group by state_name_mn, state_name_ru");
        $t3= DB::select("select d.executor_name as department_name, t.department_id, count(t.project_id) as ajliintoo from V_PROJECT t , CONST_EXECUTOR d
        where t.department_id=d.executor_id and t.state_id in (7,8,9,10,11,12,13,14,15, 41,42) ".$query. "
        group by t.department_id, d.executor_name");

        $project =DB::select("select  * from V_PROJECT t  order by project_id");
        return view('tailan.detail')->with(['t'=>$t,'t2'=>$t2,'t3'=>$t3,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'syear_id'=>$syear_id,'year'=>$year,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype,'sprojecttype'=>$sprojecttype]);


    }
    public function album()
    {

        $query = "";
        $state = State::orderby('state_name_mn')->get();
        $method = Method::orderby('method_name')->get();
        $projecttype = Projecttype::orderby('project_type_name_mn')->get();
        $constructor = Constructor::orderby('department_abbr')->get();
        $executor = Executor::orderby('executor_abbr')->get();

        $employee =DB::select('select  * from V_CONST_EMPLOYEE t where t.is_engineer=1 order by firstname');

        $sprojecttype= Input::get('sproject_type');
        if (Auth::user()->dep_id == 55 or Auth::user()->dep_id == 99) {
            $query.="";

        }
        else
        {
           
                $query.=" and department_id = '".Auth::user()->dep_id."'";
          
        }
        if ($sprojecttype!=NULL && $sprojecttype !=0) {
            $query.=" and project_type = ".$sprojecttype."";

        }
        else
        {
            $query.=" ";

        }
        $project =DB::select("select  distinct * from V_PROCESS_IMG t where plan_year=2020 ".$query. "");
        

        return view('tailan.album')->with(['method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype]);


    }

}
