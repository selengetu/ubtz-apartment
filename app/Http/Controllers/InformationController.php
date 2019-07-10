<?php

namespace App\Http\Controllers;

use Request;
use App\Information;
use App\Informationtype;
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
        $information = Information::orderby('information_name')->get();
        $type = Informationtype::all();
        return view('information')->with(['information'=>$information,'type'=>$type]);
    }

    public function store()
    {
        $inf= new Information();
        $inf->information_name = Request::input('information_name');
        $inf->img_path = Request::input('img_path');
        $inf->information_type = Request::input('information_type');
        $inf->save();
        return Redirect('information');
    }

    public function update(Request $request)
    {
        $information= DB::table('INFORMATION')
            ->where('information_id', Request::input('id'))
            ->update(['information_name' => Request::input('information_name'),'information_type' => Request::input('information_type'),'img_path' => Request::input('img_path')]);
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
        Information::where('information_id', '=', $id)->delete();
        return Redirect('information');
    }
}
