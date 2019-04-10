<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constructor;
use App\Executor;
class ExecutorController extends Controller
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
        $constructor = Constructor::orderby('department_name')->get();
        $executor = Executor::all();
        return view('set.executor')->with(['constructor'=>$constructor,'executor'=>$executor]);
    }

    public function store()
    {
        $executor = new Executor;
        $executor->executor_name = Request::input('department_name');
        $executor->executor_abbr = Request::input('department_abbr');
        $executor->executor_name_ru = Request::input('department_name_ru');
        $executor->is_ubtz = Request::input('is_ubtz');
        $executor->save();
        return Redirect('executor');
    }

    public function update(Request $request)
    {
        $executor = DB::table('SET_EXECUTOR')
            ->where('executor_id', Request::input('id'))
            ->update(['executor_name' => Request::input('executor_name'),'executor_name_ru' => Request::input('executor_name_ru'),'executor_abbr' => Request::input('executor_abbr'),'is_ubtz' => Request::input('is_ubtz')]);
        return Redirect('executor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Executor::where('executor_id', '=', $id)->delete();
        return Redirect('executor');
    }
}
