<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constructor;
use App\Prof;
class ProfController extends Controller
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
        $prof = Prof::all();
        return view('set.prof')->with(['constructor'=>$constructor,'prof'=>$prof]);
    }

    public function store()
    {
        $prof= new Prof;
        $prof->profession_name = Request::input('profession_name');
        $prof->description = Request::input('description');
        $prof->save();
        return Redirect('prof');
    }

    public function update(Request $request)
    {
        $prof= DB::table('SET_PROFESSION')
            ->where('profession_id', Request::input('id'))
            ->update(['profession_name' => Request::input('profession_name'),'description' => Request::input('description')]);
        return Redirect('prof');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Prof::where('profession_id', '=', $id)->delete();
        return Redirect('profession');
    }
}
