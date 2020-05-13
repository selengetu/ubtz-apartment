<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Request;
use App\Constructor;
use App\Employee;
use App\Hurungu;
use App\Year;
use App\Executor;
use DB;
use Auth;
use Session;
use Illuminate\Support\Facades\Input;


class HurunguController extends Controller
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
        $schildabbr = Input::get('schildabbr_id');
        $executor = DB::select("select * from V_EXECUTOR t, CONST_DEPARTMENT d where t.executor_par = d.department_id order by t.executor_par ,t.executor_type,t.executor_abbr");
        $constructor = Constructor::orderby('department_abbr')->get();
        $year = Year::orderby('year_name')->get();
        if ($schildabbr!=NULL && $schildabbr !=0) {
            $type =DB::select('select t.executor_type from V_EXECUTOR t where t.executor_id =  '. $schildabbr.'');
            if ($type[0]->executor_type ==1){
                $dep =DB::select('select t.department_id from V_EXECUTOR t where t.executor_id =  '. $schildabbr.'');

                $query.=" and depart_id = '".$dep[0]->department_id."'";
            }
            else{
                $query.=" and depart_child = '".$schildabbr."'";
            }
        }
        else
        {
            $schildabbr=0;
            $query.=" ";

        }
        $syear_id= Input::get('syear_id');
        if(Session::has('syear_id')) {
            $syear_id = Session::get('syear_id');
        }
        else {
            Session::put('syear_id', $syear_id);
        }
        if ($syear_id!=NULL && $syear_id !=0) {
            $query.=" and year = '".$syear_id."'";

        }
        else
        {
            $syear_id=2020;
            $query.="and year = 2020";

        }
        $hurungu =  DB::select("select * from V_INVESTMENT where 1=1 " .$query. " order by investment_id");
        return view('hurungu')->with(['syear_id'=>$syear_id,'year'=>$year,'executor'=>$executor,'constructor'=>$constructor,'hurungu'=>$hurungu]);
    }
    public function store()
    {
        $hurungu = new Hurungu;
        $hurungu->depart_id = Request::input('constructor_id');
        $hurungu->depart_child = Request::input('childabbr_id');
        $hurungu->plan = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan'));
        $hurungu->plan1 = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan1'));
        $hurungu->plan2 = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan2'));
        $hurungu->plan3 = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan3'));
        $hurungu->plan4 = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan4'));
        $hurungu->budget1 = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('budget1'));
        $hurungu->budget2 = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('budget2'));
        $hurungu->budget3 = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('budget3'));
        $hurungu->budget4 = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('budget4'));
        $hurungu->description = Request::input('description');
        $hurungu->year = Carbon::now()->year;
        $hurungu->save();
        return Redirect('hurungu');
    }

    public function update(Request $request)
    {
        $hurungu = DB::table('INVESTMENT')
            ->where('investment_id', Request::input('id'))
            ->update(['depart_id' => Request::input('constructor_id'),'depart_child' => Request::input('childabbr_id'),'plan' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan'))
                ,'plan1' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan1')),'plan2' =>preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan2')),'plan3' =>preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan3')),'plan4' =>preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('plan4'))
                ,'budget1' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('budget1')),'budget2' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('budget2')),'budget3' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('budget3')) ,'budget4' => preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('budget4'))
                ,'description' => Request::input('description')]);
        return Redirect('hurungu');
    }

    public function destroy($id)
    {
        Hurungu::where('investment_id', '=', $id)->delete();
        return Redirect('hurungu');
    }
    public function report()
    {
        $query = "";
        $schildabbr = Input::get('schildabbr_id');
        $year = Year::orderby('year_name')->get();
        $executor = DB::select("select * from V_EXECUTOR t, CONST_DEPARTMENT d where t.executor_par = d.department_id order by t.executor_par ,t.executor_type,t.executor_abbr");
        $constructor = Constructor::orderby('department_abbr')->get();

        if ($schildabbr!=NULL && $schildabbr !=0) {
            $type =DB::select('select t.executor_type from V_EXECUTOR t where t.executor_id =  '. $schildabbr.'');
            if ($type[0]->executor_type ==1){
                $dep =DB::select('select t.department_id from V_EXECUTOR t where t.executor_id =  '. $schildabbr.'');

                $query.=" and depart_id = '".$dep[0]->department_id."'";
            }
            else{
                $query.=" and depart_child = '".$schildabbr."'";
            }
        }
        else
        {
            $schildabbr=0;
            $query.=" ";

        }
        if (Auth::user()->dep_id == 22 or Auth::user()->dep_id == 99 ) {
            $query.="";

        }
        else
        {
            $query.=" and depart_id = '".Auth::user()->dep_id."'";

        }
        $syear_id= Input::get('syear_id');
        if(Session::has('syear_id')) {
            $syear_id = Session::get('syear_id');
        }
        else {
            Session::put('syear_id', $syear_id);
        }
        if ($syear_id!=NULL && $syear_id !=0) {
            $query.=" and year = '".$syear_id."'";

        }
        else
        {
            $syear_id=2020;
            $query.="and year = 2020";

        }
        $hurungu =  DB::select("select * from V_INVESTMENT where 1=1 " .$query. " order by investment_id");
        return view('tailan.hurungurep')->with(['syear_id'=>$syear_id,'year'=>$year,'executor'=>$executor,'constructor'=>$constructor,'hurungu'=>$hurungu]);
    }
}
