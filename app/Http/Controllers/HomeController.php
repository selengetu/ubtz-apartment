<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
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
        $t =DB::select('select * from TAILAN_PROJECT t');

        $t2 =DB::select("select d.executor_name, t.department_child,d.executor_abbr,t.department_id, t.department_name ,sum(t.plan) as plan, sum(t.budget) as budget, sum(t.estimation) as estimation,  (sum(t.estimation)/sum(t.plan))*100 as percent, sum(t.estimation)-sum(t.plan) as diff,count(t.executor_id)as niit, (sum(t.percent)/count(t.percent)) as rpercent from V_PROJECT t , CONST_EXECUTOR d
                        where t.department_child=d.executor_id and t.department_id=6
                        group by t.department_child,d.executor_name,t.department_id, t.department_name,d.executor_abbr");
        $t3 =DB::select("select t.project_type, t.project_type_name_mn, t.project_type_name_ru, (sum(t.budget)/sum(t.plan))*100 as niit  from V_PROJECT t
                        group by t.project_type, t.project_type_name_mn, t.project_type_name_ru");
        return view('welcome')->with(['t'=>$t,'t2'=>$t2,'t3'=>$t3]);
    }
}
