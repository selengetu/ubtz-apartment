<?php

namespace App\Http\Controllers;

use App\Projecttype;
use Request;
use Session;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Constructor;
use App\Imagefile;
use App\Executor;
use App\Employee;
use App\Project;
use App\Method;
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
        $state = State::orderby('state_name_mn')->get();
        $method = Method::orderby('method_name')->get();
        $projecttype = Projecttype::orderby('project_type_name_mn')->get();
        $constructor = Constructor::orderby('department_abbr')->get();
        $executor = Executor::orderby('executor_abbr')->get();
        $srespondent_emp_id = Input::get('resp1');
        Session::put('srespondent_emp_id', $srespondent_emp_id);
        $employee =DB::select('select  * from V_CONST_EMPLOYEE t where t.is_engineer=1 order by firstname');
        $process = new Process;
        $process ->project_id = Request::input('gproject_id');
        $process ->budget = preg_replace('/[a-zZ-a,]/', '',Request::input('gbudget'));
        $process ->month = Request::input('gmonth');
        $process ->register_date = Carbon::now();
        $process ->respondent_emp_id = Auth::user()->id;
        $process ->description = Request::input('gdescription');
        if (Request::hasFile('image')) {
            $process->image_b = 1;
        }
        else{
            $process->image_b = 0;
        }
        $process ->year = Carbon::now()->year;
        $process ->state_id = Request::input('gstate_id');

        $process->save();
        if (Request::hasFile('image')) {
            $photo = Input::file('image');

            foreach ($photo as $photos) {

                $file = request()->file('image');
                $filenamewithextension = $photos->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $photos->getClientOriginalExtension();

                $size = $photos->getSize();
                $filenametostore = date('YmdHisu') . '_2' . '.' . $extension;

                $filenametostoreb = date('YmdHisu') . '_1' . '.' . $extension;

                Storage::put('profile_images/thumbnail/' . $filenametostore, fopen($photos, 'r+'));
                Storage::put('profile_images/img/' . $filenametostoreb, fopen($photos, 'r+'));
                //Resize image here
                $thumbnailpath = public_path('profile_images/thumbnail/' . $filenametostore);
                $img1 = Image::make($photos->getRealPath())->resize(400, 150, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img1->save($thumbnailpath);
                $imgpath = public_path('profile_images/img/' . $filenametostoreb);
                $img = Image::make($photos->getRealPath())->resize(800, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($imgpath);

                $img = new Imagefile;
                $img->img_bname = $filenametostoreb;
                $img->img_name = $filenametostore;
                $img->img_ext = $extension;
                $img->img_size = $size;
                $img->process_id = $process->process_id;
                $img->save();

            }
        }
        Session::flash('gproject_id',Request::input('gproject_id'));
        $states = DB::select("select t.state_id as state from V_PROCESS t where t.process_id = (select max(v.process_id) from V_PROCESS v where v.project_id=".$data.")");
        $description = DB::select("select t.description as description from V_PROCESS t where t.process_id = (select max(v.process_id) from V_PROCESS v where v.project_id=".$data.")");

        if(Request::input('gstate_id') != 1){

            $plan = DB::select("select plan from V_PROJECT t where t.project_id=".$data."");
          
            if($plan[0]->plan != NULL) {

                $budget = DB::select("select sum(t.budget) as totalbudget from V_PROCESS t where t.project_id=" . $data . "");
              
                $percent = ($budget[0]->totalbudget / $plan[0]->plan) * 100;
   
                $process = DB::table('Project')
                    ->where('project_id', $data)
                    ->update(['budget' => $budget[0]->totalbudget, 'percent' => $percent]);
                if(Request::input('gdate') != NULL) {
                    $process = DB::table('Project')
                        ->where('project_id', $data)
                        ->update(['prend_date' => Request::input('gdate')]);
                }
            }
            if($plan[0]->plan == NULL) {

                $budget = DB::select("select sum(t.budget) as totalbudget from V_PROCESS t where t.project_id=" . $data . "");
             
                $process = DB::table('Project')
                    ->where('project_id', $data)
                    ->update(['budget' => $budget[0]->totalbudget, 'percent' => 0]);
                if(Request::input('gdate') != NULL) {
                    $process = DB::table('Project')
                        ->where('project_id', $data)
                        ->update(['prend_date' => Request::input('gdate')]);
                }
            }
            if($states != NULL){
                $process = DB::table('Project')
                    ->where('project_id',$data)
                    ->update(['state_id' => $states[0]->state,'description' => $description[0]->description]);
                if($states[0]->state == 1){
                    $bud = DB::select("select case when count(*)<1 then 0 else max(nvl(t.budget,0)) end budget from Project t where t.project_id=" . $data . "")[0]->budget;
                    $process = DB::table('Project')
                        ->where('project_id',$data)
                        ->update(['economic' => $bud]);
                }
                if( $state[0]->state != 1){
                    $process = DB::table('Project')

                        ->where('project_id',$data)
                        ->update(['economic' => 0]);
                }
            }

        }
        if(Request::input('gstate_id') == 1){

            $budget = DB::select("select sum(t.budget) as totalbudget from V_PROCESS t where t.project_id=" . $data . "");

            if($states != NULL){
                $process = DB::table('Project')
                    ->where('project_id',$data)
                    ->update(['budget' => $budget[0]->totalbudget,'state_id' => $states[0]->state,'percent' => '100','description' => $description[0]->description]);
                if(Request::input('gdate') != NULL) {
                    $process = DB::table('Project')
                        ->where('project_id', $data)
                        ->update(['prend_date' => Request::input('gdate')]);
                }

                if( $states[0]->state == 1){
                    $bud = DB::select("select case when count(*)<1 then 0 else max(nvl(t.budget,0)) end budget from Project t where t.project_id=" . $data . "")[0]->budget;

                    $process = DB::table('Project')
                        ->where('project_id',$data)
                        ->update(['economic' => $bud]);
                }

            }

            if($states == NULL){
                $process = DB::table('Project')
                    ->where('project_id',$data)
                    ->update(['budget' => $budget[0]->totalbudget,'percent' => '100']);
                if(Request::input('gdate') != NULL) {
                    $process = DB::table('Project')
                        ->where('project_id', $data)
                        ->update(['prend_date' => Request::input('gdate')]);
                }

            }

        }
       return back();


    }

    public function update(Request $request)
    {

        $data= Request::input('gproject_id');
        if (Request::hasFile('image')) {
            $process = DB::table('Project_process')
                ->where('process_id', Request::input('gprocess_id'))->update(['image_b' => 1]);
        }
        else{
                $process = DB::table('Project_process')
                    ->where('process_id',Request::input('gprocess_id'))->update(['image_b' => 0]);
        }
        $process = DB::table('Project_process')
            ->where('process_id', Request::input('gprocess_id'))
            ->update(['budget' =>  preg_replace('/[a-zZ-a,]/', '',Request::input('gbudget')),'month' => Request::input('gmonth')
                ,'description' => Request::input('gdescription'),'state_id' => Request::input('gstate_id')]);

        $state = DB::select("select t.state_id as state from V_PROCESS t where t.process_id = (select max(v.process_id) from V_PROCESS v where v.project_id=".$data.")");
        $description = DB::select("select t.description as description from V_PROCESS t where t.process_id = (select max(v.process_id) from V_PROCESS v where v.project_id=".$data.")");
            $budget = DB::select("select sum(t.budget) as totalbudget from V_PROCESS t where t.project_id=" . $data . "");
            $plan = DB::select("select plan from V_PROJECT t where t.project_id=".$data."");

        if (Request::hasFile('image')) {
            $photo = Input::file('image');

            foreach ($photo as $photos) {

                $file = request()->file('image');
                $filenamewithextension = $photos->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $photos->getClientOriginalExtension();

                $size = $photos->getSize();
                //filename to store
                $filenametostore = date('YmdHisu') . '_2' . '.' . $extension;

                $filenametostoreb = date('YmdHisu') . '_1' . '.' . $extension;

                Storage::put('profile_images/thumbnail/' . $filenametostore, fopen($photos, 'r+'));

                Storage::put('profile_images/img/' . $filenametostoreb, fopen($photos, 'r+'));
                //Resize image here
                $thumbnailpath = public_path('profile_images/thumbnail/' . $filenametostore);

                $img1 = Image::make($photos->getRealPath())->resize(400, 150, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img1->save($thumbnailpath);
                $imgpath = public_path('profile_images/img/' . $filenametostoreb);
                $img = Image::make($photos->getRealPath())->resize(800, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($filenametostoreb);
                $img->save($imgpath);

                $img = new Imagefile;
                $img->img_bname = $filenametostoreb;
                $img->img_name = $filenametostore;
                $img->img_ext = $extension;
                $img->img_size = $size;
                $img->process_id = Request::input('gprocess_id');
                $img->save();

            }
        }


        if(Request::input('gstate_id') != 1){

            if($plan != NULL ) {
                
                if ($plan[0]->plan != NULL) {
                   
                    $percent = ($budget[0]->totalbudget / $plan[0]->plan) * 100;
                    $process = DB::table('Project')
                        ->where('project_id', $data)
                        ->update(['budget' => $budget[0]->totalbudget, 'percent' => $percent]);
                    if($state != NULL) {
                        $process = DB::table('Project')
                            ->where('project_id', $data)
                            ->update(['state_id' => $state[0]->state,'description' => $description[0]->description]);
                        if( $state[0]->state == 1){
                            $bud = DB::select("select case when count(*)<1 then 0 else max(nvl(t.budget,0)) end budget from Project t where t.project_id=" . $data . "")[0]->budget;
                            $process = DB::table('Project')
                                ->where('project_id',$data)
                                ->update(['economic' => $bud]);
                        }
                        if( $state[0]->state != 1){
                            $process = DB::table('Project')

                                ->where('project_id',$data)
                                ->update(['economic' => 0]);
                        }
                    }
                }
                if ($plan[0]->plan == NULL) {

                   
                    $process = DB::table('Project')
                        ->where('project_id', $data)
                        ->update(['budget' => $budget[0]->totalbudget]);
                    if($state != NULL) {
                        $process = DB::table('Project')
                            ->where('project_id', $data)
                            ->update(['state_id' => $state[0]->state,'description' => $description[0]->description]);
                        if( $state[0]->state == 1){
                            $bud = DB::select("select case when count(*)<1 then 0 else max(nvl(t.budget,0)) end budget from Project t where t.project_id=" . $data . "")[0]->budget;
                            $process = DB::table('Project')
                                ->where('project_id',$data)
                                ->update(['economic' => $bud]);
                        }
                        if( $state[0]->state != 1){
                            $process = DB::table('Project')

                                ->where('project_id',$data)
                                ->update(['economic' => 0]);
                        }
                    }
                }
            }
        }
        if(Request::input('gstate_id') == 1){

            $budget = DB::select("select sum(t.budget) as totalbudget from V_PROCESS t where t.project_id=" . $data . "");

            if($state != NULL){
                $process = DB::table('Project')
                    ->where('project_id',$data)
                    ->update(['budget' => $budget[0]->totalbudget,'state_id' => Request::input('gstate_id'),'percent' => '100','description' => $description[0]->description]);
                if(Request::input('gdate') != NULL) {
                    $process = DB::table('Project')
                        ->where('project_id', $data)
                        ->update(['prend_date' => Request::input('gdate')]);
                }

                if( $state[0]->state == 1){
                    $bud = DB::select("select case when count(*)<1 then 0 else max(nvl(t.budget,0)) end budget from Project t where t.project_id=" . $data . "")[0]->budget;

                    $process = DB::table('Project')

                        ->where('project_id',$data)
                        ->update(['economic' => $bud]);
                }
                if( $state[0]->state != 1){
                    $process = DB::table('Project')
                        ->where('project_id',$data)
                        ->update(['economic' => 0]);
                }
            }

            if($state == NULL){
                $process = DB::table('Project')
                    ->where('project_id',$data)
                    ->update(['budget' => $budget[0]->totalbudget,'percent' => '100']);
                if(Request::input('gdate') != NULL) {
                    $process = DB::table('Project')
                        ->where('project_id', $data)
                        ->update(['prend_date' => Request::input('gdate')]);
                }
            }
        }

        Session::flash('gproject_id',Request::input('gproject_id'));
        if(Request::input('proc')== 1){
            return back()->withInput();
        }

        if(Request::input('proc')== 2){
            return back()->withInput();
        }

    }

    public function destroy($id,$id1)
    {

        $data= $id1;

        Process::where('process_id', '=', $id)->delete();
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
            if ($plan[0]->plan == NULL) {
         
                $process = DB::table('Project')
                    ->where('project_id', $data)
                    ->update(['budget' => $budget[0]->totalbudget]);

            }
        }
        if($state != NULL) {
            $process = DB::table('Project')
                ->where('project_id', $data)
                ->update(['state_id' => $state[0]->state,'description' => $description[0]->description]);
            if( $state[0]->state == 1){
                $bud = DB::select("select case when count(*)<1 then 0 else max(nvl(t.budget,0)) end budget from Project t where t.project_id=" . $data . "")[0]->budget;
                $process = DB::table('Project')

                    ->where('project_id',$data)
                    ->update(['economic' => $bud,'percent' => 100 ]);
            }
            if( $state[0]->state != 1){
                $process = DB::table('Project')

                    ->where('project_id',$data)
                    ->update(['economic' => 0]);
            }
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

        return Redirect('barilga');
    }
    public function approve(Request $request)
    {
        $process = DB::table('Project_process')
            ->where('process_id', Request::input('gprocess_id'))
            ->update(['is_approved' =>1,'approved_date' =>Carbon::today(),'approved_id' =>Auth::user()->id]);

        if(Request::input('proc')== 1){
            return Redirect('zaswar');
        }

        if(Request::input('proc')== 2){
            return Redirect('barilga');
        }
    }
    public function deletepicture($id,$id1)
    {

        Imagefile::where('img_id', '=', $id)->delete();
        $department = DB::table('PROCESS_IMG')
            ->where('process_id', '=', $id1)->exists();
        if ($department == false) {
            $department = DB::table('PROJECT_PROCESS')
                ->where('process_id', $id1)
                ->update(['image_b' =>0]);
           }
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);

    }
}
