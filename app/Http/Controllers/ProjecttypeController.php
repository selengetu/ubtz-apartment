<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constructor;
use App\Projecttype;
class ProjecttypeController extends Controller
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
        $projecttype = Projecttype::orderby('project_type_id')->get();
        return view('set.projecttype')->with(['projecttype'=>$projecttype]);
    }

    public function store()
    {
        $projecttype = new Projecttype;
        $projecttype->project_type_name_mn = Request::input('project_type_name_mn');
        $projecttype->project_type_name_ru = Request::input('project_type_name_ru');
        $projecttype->save();
        return Redirect('projecttype');
    }

    public function update(Request $request)
    {
        $projecttype = DB::table('CONST_projecttype')
            ->where('project_type_id', Request::input('id'))
            ->update(['project_type_name_ru' => Request::input('project_type_name_ru'),'project_type_name_mn' => Request::input('project_type_name_mn')]);
        return Redirect('projecttype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Executor::where('project_type_id', '=', $id)->delete();
        return Redirect('projecttype');
    }
}
