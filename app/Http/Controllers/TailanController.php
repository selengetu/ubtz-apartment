<?php

namespace App\Http\Controllers;

use App\Projecttype;
use Request;
use Session;
use App\Constructor;
use App\Executor;
use App\Employee;
use App\Project;
use App\Method;
use App\State;
use DB;
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
        $state = State::orderby('state_name_mn')->get();
        $method = Method::orderby('method_name')->get();
        $projecttype = Projecttype::orderby('project_type_name_mn')->get();
        $constructor = Constructor::orderby('department_abbr')->get();
        $executor = DB::select("select * from V_EXECUTOR t, CONST_DEPARTMENT d where t.executor_par = d.department_id order by t.executor_par ,t.executor_type,t.executor_abbr");
        $month = Input::get('month');
        $employee =DB::select('select  * from V_CONST_EMPLOYEE t where t.is_engineer=1 order by firstname');
        $schildabbr= Input::get('schildabbr_id');
        $sstate_id= Input::get('sstate_id');
        $sexecutor = Input::get('sexecutor_id');
        $sconstructor = Input::get('sconstructor_id');
        $srespondent_emp_id = Input::get('srespondent_emp_id');
        $startdate= Input::get('date1');
        $enddate = Input::get('date2');
        if (Auth::user()->dep_id == 22) {
            $query.="";

        }
        else
        {
            $query.=" and department_id = '".Auth::user()->dep_id."'";

        }
        if ($startdate !=0 && $startdate && $enddate !=0 && $enddate !=0-NULL) {
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
            $query.=" and state_id = '".$sstate_id."'";

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
       u.season_name,
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
       u.method_code,
       u.method_name,
       u.percent,
       u.executor_id,
       u.executor_abbr,
       u.project_name_ru,
       u.start_date,
       u.end_date,
       u.report_rowno,
       q.image_b1,
       q.image_b2
       from
       v_project u,
(select r.process_id, r.image_b as image_b1, e.process_id, e.image_b as image_b2, r.project_id
from PROJECT_PROCESS r, PROJECT_PROCESS e,
(select project_id, min(process_id) mi, max(process_id) ma from PROJECT_PROCESS
group by project_id) t
where r.process_id = t.mi
and e.process_id = t.ma
) q,
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
where q.project_id(+)=u.project_id and par.project_id=u.project_id ".$date1." ".$query."
order by report_rowno, ex_report_no, xex_report_no");

        return view('tailan.main')->with(['month'=>$month,'gproject_id'=>$gproject_id,'data'=>$data,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype,'sprojecttype'=>$sprojecttype]);
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
        if (Auth::user()->dep_id == 22) {
            $query.="";

        }
        else
        {
            $query.=" and department_id = '".Auth::user()->dep_id."'";

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
        $project =DB::select("select  * from V_PROJECT t  where 1=1 " .$query. " order by project_id");
        return view('tailan.time')->with(['sstate_id'=>$sstate_id,'srespondent_emp_id'=>$srespondent_emp_id,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'sprojecttype'=>$sprojecttype,'gproject_id'=>$gproject_id,'data'=>$data,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'sconstructor'=>$sconstructor,'sexecutor'=>$sexecutor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype]);
    }
    public function geree()
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
        $schildabbr = Input::get('schildabbr_id');
        $srespondent_emp_id = Input::get('srespondent_emp_id');
        $sprojecttype= Input::get('sproject_type');
        $startdate= Input::get('date1');
        $enddate = Input::get('date2');
        if (Auth::user()->dep_id == 22) {
            $query.="";

        }
        else
        {
            $query.=" and department_id = '".Auth::user()->dep_id."'";

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
            $query.=" and executor_id = '".$sexecutor."'";

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
        return view('tailan.geree')->with(['sstate_id'=>$sstate_id,'srespondent_emp_id'=>$srespondent_emp_id,'schildabbr'=>$schildabbr,'sexecutor'=>$sexecutor,'sprojecttype'=>$sprojecttype,'gproject_id'=>$gproject_id,'data'=>$data,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'sexecutor'=>$sexecutor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype]);
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



        if ($sprojecttype!=NULL && $sprojecttype !=0) {
            $query.=" and project_type = ".$sprojecttype."";

        }
        else
        {
            $query.=" ";

        }

        $t =DB::select("select d.department_name, t.department_id,d.department_type, sum(t.plan) as plan, sum(t.budget) as budget, sum(t.estimation) as estimation,  (sum(t.budget)/sum(t.plan))*100 as percent, sum(t.budget)-sum(t.plan) as diff, (sum(t.percent)/count(percent)) as rpercent , count(t.project_id) as ajliintoo from V_PROJECT t , CONST_DEPARTMENT d
where t.department_id=d.department_id ".$query. "
group by d.department_type,t.department_id, d.department_name
order by t.department_id");
        $t2 =DB::select("select d.executor_name, t.department_child,d.executor_abbr,t.department_id, t.department_name ,sum(t.plan) as plan, sum(t.budget) as budget, sum(t.estimation) as estimation,  (sum(t.budget)/sum(t.plan))*100 as percent, sum(t.budget)-sum(t.plan) as diff,count(t.executor_id)as niit, (sum(t.percent)/count(t.percent)) as rpercent from V_PROJECT t , CONST_EXECUTOR d
where t.department_child=d.executor_id and t.department_id=2 ".$query. "
group by t.department_child,d.executor_name,t.department_id, t.department_name,d.executor_abbr");
        $det= DB::select("select b.* ,q.* from 
(select d.department_name, t.department_id,d.department_type, sum(t.plan) as plan, sum(t.budget) as budget, sum(t.estimation) as estimation,  (sum(t.budget)/sum(t.plan))*100 as percent, sum(t.budget)-sum(t.plan) as diff, (sum(t.percent)/count(percent)) as rpercent , count(t.project_id) as ajliintoo from V_PROJECT t , CONST_DEPARTMENT d
where t.department_id=d.department_id  ".$query. "
group by d.department_type,t.department_id, d.department_name
order by t.department_id) b inner join 
(SELECT * FROM 
(
SELECT department_id ,state_id
        FROM project 
        where 1=1  ".$query. "
      )
PIVOT  
(count(state_id) FOR state_id IN (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16)
)
ORDER BY department_id) q
on q.department_id=b.department_id");;
        $project =DB::select("select  * from V_PROJECT t  order by project_id");
        return view('tailan.analyse')->with(['t'=>$t,'t2'=>$t2,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype,'sprojecttype'=>$sprojecttype]);


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
        $t= DB::select("select b.* ,q.* ,(q.eune+q.egeree+ezurag+etusuv+emater+esanh+eguits+etusuv) as ehleegui from 
(select d.department_name, t.department_id,d.department_type, sum(t.plan) as plan, sum(t.budget) as budget, sum(t.estimation) as estimation,  (sum(t.budget)/sum(t.plan))*100 as percent, sum(t.budget)-sum(t.plan) as diff, (sum(t.percent)/count(percent)) as rpercent , count(t.project_id) as ajliintoo from V_PROJECT t , CONST_DEPARTMENT d
where t.department_id=d.department_id  ".$query. "
group by d.department_type,t.department_id, d.department_name) b inner join 

(SELECT * FROM 
(
SELECT department_id ,state_id
        FROM v_project  
        where 1=1  ".$query. "
      
      )
PIVOT  
(count(state_id) FOR state_id IN (1 as haasan,2 as duussan ,3 as gdag,4 as ghots,5 as gadgeree ,6 as nem,7 as eune,8 as egeree,9 as ezurag,10 as etul,11 as emater,12 as esanh ,13 as eguits ,14 as etusuv,16 as boloogui)
)
ORDER BY department_id) q
on q.department_id=b.department_id");
        $t2= DB::select("select state_name_ru , state_name_mn ,count(project_name) as niit 
from v_project t 
where t.state_id in (1,2,3,4,5,6) ".$query. "
group by state_name_mn, state_name_ru");
        $t3= DB::select("select d.department_name, t.department_id, count(t.project_id) as ajliintoo from V_PROJECT t , CONST_DEPARTMENT d
where t.department_id=d.department_id and t.state_id in (7,8,9,10,11,12,13,14,15)  ".$query. "
group by t.department_id, d.department_name
order by t.department_id
");

        $project =DB::select("select  * from V_PROJECT t  order by project_id");
        return view('tailan.detail')->with(['t'=>$t,'t2'=>$t2,'t3'=>$t3,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype,'sprojecttype'=>$sprojecttype]);


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
        if (Auth::user()->dep_id == 22) {
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


        $project =DB::select("select  * from V_PROJECT_IMAGE2 t where 1=1 ".$query. "");
        return view('tailan.album')->with(['method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype]);


    }
}
