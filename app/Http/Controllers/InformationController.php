<?php

namespace App\Http\Controllers;

use Request;
use App\Constructor;
use App\Executor;
use DB;
class InformationController extends Controller
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
        return view('information')->with(['constructor'=>$constructor,'executor'=>$executor]);
    }

    public function store()
    {

        return Redirect('information');
    }

    public function update(Request $request)
    {

        return Redirect('information');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Executor::where('information_id', '=', $id)->delete();
        return Redirect('information');
    }
}
