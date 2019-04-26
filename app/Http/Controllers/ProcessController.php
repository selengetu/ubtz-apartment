<?php

namespace App\Http\Controllers;

use App\Projecttype;
use Request;
use App\Constructor;
use App\Executor;
use App\Employee;
use App\Project;
use Carbon;
use App\State;
use Auth;
use App\Process;
use Illuminate\Support\Facades\Input;
use DB;
class ProcessController extends Controller
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
        return view('process')->with(['constructor'=>$constructor,'executor'=>$executor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype]);
    }
    public function store()
    {
        $data= Request::input('gproject_id');


        $process = new Process;
        $process ->project_id = Request::input('gproject_id');
        $process ->budget = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('gbudget'));
        $process ->month = Request::input('gmonth');
        $process ->register_date = Carbon\Carbon::now();
        $process ->respondent_emp_id = Auth::user()->id;
        $process ->description = Request::input('gdescription');

        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images'), $imageName);
        $process ->image_b =$imageName;
        $process ->image_s =$imageName;
        $process ->year = Request::input('gyear');
        $process ->state_id = Request::input('gstate_id');
        $process->save();

        $state = DB::select("select t.state_id as state from V_PROCESS t where t.process_id = (select max(v.process_id) from V_PROCESS v where v.project_id=".$data.")");
        $est = DB::select("select estimation from V_PROJECT t where t.project_id=".$data."");

        $budget = DB::select("select sum(t.budget) as totalbudget from V_PROCESS t where t.project_id=".$data."");
        $percent=($budget[0]->totalbudget / $est[0]->estimation)*100;
        $process = DB::table('Project')
            ->where('project_id',$data)
            ->update(['budget' => $budget[0]->totalbudget ,'state_id' => $state[0]->state,'percent' => $percent]);
        return Redirect('barilga')->with(['data'=>$data]);
    }

    public function update(Request $request)
    {
        $data= Request::input('eproject_id');
        $process = DB::table('Project_process')
            ->where('process_id', Request::input('eprocess_id'))
            ->update(['budget' =>  preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('ebudget')),'month' => Request::input('emonth'),'year' => Request::input('eyear')
                ,'description' => Request::input('edescription'),'state_id' => Request::input('estate_id')]);

        $state = DB::select("select t.state_id as state from V_PROCESS t where t.process_id = (select max(v.process_id) from V_PROCESS v where v.project_id=".$data.")");
        $est = DB::select("select estimation from V_PROJECT t where t.project_id=".$data."");

        $budget = DB::select("select sum(t.budget) as totalbudget from V_PROCESS t where t.project_id=".$data."");
        $percent=($budget[0]->totalbudget / $est[0]->estimation)*100;
        $process = DB::table('Project')
            ->where('project_id',$data)
            ->update(['budget' => $budget[0]->totalbudget ,'state_id' => $state[0]->state,'percent' => $percent,'percent' => $percent]);
        return Redirect('barilga');
    }

    public function destroy($id,$id1)
    {
        $data= $id1;
        Process::where('process_id', '=', $id)->delete();
        $state = DB::select("select t.state_id as state from V_PROCESS t where t.process_id = (select max(v.process_id) from V_PROCESS v where v.project_id=".$data.")");
        $est = DB::select("select estimation from V_PROJECT t where t.project_id=".$data."");

        $budget = DB::select("select sum(t.budget) as totalbudget from V_PROCESS t where t.project_id=".$data."");
        $percent=($budget[0]->totalbudget / $est[0]->estimation)*100;
        $process = DB::table('Project')
            ->where('project_id',$data)
            ->update(['budget' => $budget[0]->totalbudget ,'state_id' => $state[0]->state,'percent' => $percent]);
        return Redirect('barilga');
    }
}
