<?php

namespace App\Http\Controllers;

use App\Projecttype;
use Request;
use Image;
use Illuminate\Support\Facades\Storage;
use App\Constructor;
use App\Executor;
use App\Employee;
use App\Project;
use App\Method;
use App\State;
use Carbon;
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

        $state = State::orderby('state_name_mn')->get();
        $method = Method::orderby('method_name')->get();
        $projecttype = Projecttype::orderby('project_type_name_mn')->get();
        $constructor = Constructor::orderby('department_abbr')->get();
        $executor = Executor::orderby('executor_abbr')->get();
        $employee =DB::select('select  * from V_CONST_EMPLOYEE t where t.is_engineer=1 order by firstname');
        $process = new Process;
        $process ->project_id = Request::input('gproject_id');
        $process ->budget = preg_replace('/[^A-Za-z0-9\-]/', '',Request::input('gbudget'));
        $process ->month = Request::input('gmonth');
        $process ->register_date = Carbon\Carbon::now();
        $process ->respondent_emp_id = Auth::user()->id;
        $process ->description = Request::input('gdescription');
        if (Request::hasFile('image')) {
            $file = request()->file('image');
            $filenamewithextension = $file->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $file->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            $filenametostoreb = $filename.'_'.uniqid().'.'.$extension;

            Storage::put('profile_images/'. $filenametostore, fopen($file, 'r+'));
            Storage::put('profile_images/thumbnail/'. $filenametostore, fopen($file, 'r+'));

            Storage::put('profile_images/'. $filenametostoreb, fopen($file, 'r+'));
            Storage::put('profile_images/img/'. $filenametostoreb, fopen($file, 'r+'));
            //Resize image here
            $thumbnailpath = public_path('profile_images/thumbnail/'.$filenametostore);
            $img = Image::make($file->getRealPath())->resize(400, 150, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath. $filenametostore);
            $imgpath = public_path('profile_images/img/'.$filenametostoreb);
            $img = Image::make($file->getRealPath())->save($imgpath. $filenametostoreb);


            $process ->image_b =$filenametostore;
            $process ->image_s =$filenametostore;

        }

        $process ->year = Request::input('gyear');
        $process ->state_id = Request::input('gstate_id');
        $process->save();

        $states = DB::select("select t.state_id as state from V_PROCESS t where t.process_id = (select max(v.process_id) from V_PROCESS v where v.project_id=".$data.")");

        if(Request::input('gpercent') == NULL){
            $est = DB::select("select estimation from V_PROJECT t where t.project_id=".$data."");

            $budget = DB::select("select sum(t.budget) as totalbudget from V_PROCESS t where t.project_id=".$data."");
            $percent=($budget[0]->totalbudget / $est[0]->estimation)*100;
            $process = DB::table('Project')
                ->where('project_id',$data)
                ->update(['budget' => $budget[0]->totalbudget ,'state_id' => $states[0]->state,'percent' => $percent]);
        }
        else{
            $process = DB::table('Project')
                ->where('project_id',$data)
                ->update(['state_id' => $states[0]->state,'percent' => Request::input('gpercent')]);
        }

        $project =DB::select("select  * from V_PROJECT t  order by project_id");
        return view('barilga')->with(['data'=>$data,'method'=>$method,'constructor'=>$constructor,'executor'=>$executor,'employee'=>$employee,'project'=>$project,'state'=>$state,'projecttype'=>$projecttype]);
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
            ->update(['budget' => $budget[0]->totalbudget ,
                'state_id' => $state[0]->state,'percent' => $percent,'percent' => $percent]);
        if (Request::hasFile('eimage')) {
            $file = request()->file('eimage');
            $filenamewithextension = $file->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $file->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            $filenametostoreb = $filename.'_'.uniqid().'.'.$extension;

            Storage::put('profile_images/'. $filenametostore, fopen($file, 'r+'));
            Storage::put('profile_images/thumbnail/'. $filenametostore, fopen($file, 'r+'));

            Storage::put('profile_images/'. $filenametostoreb, fopen($file, 'r+'));
            Storage::put('profile_images/img/'. $filenametostoreb, fopen($file, 'r+'));
            //Resize image here
            $thumbnailpath = public_path('profile_images/thumbnail/'.$filenametostore);
            $img = Image::make($file->getRealPath())->resize(400, 150, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath. $filenametostore);
            $imgpath = public_path('profile_images/img/'.$filenametostoreb);
            $img = Image::make($file->getRealPath())->save($imgpath. $filenametostoreb);


            $process = DB::table('Project_process')
                ->where('process_id', Request::input('eprocess_id'))
                ->update(['image_b' => $imgpath , 'image_s' => $img]);

        }


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
