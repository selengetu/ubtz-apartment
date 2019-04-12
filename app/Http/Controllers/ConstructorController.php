<?php

namespace App\Http\Controllers;

use Request;
use App\Constructor;
use DB;
class ConstructorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $constructor = Constructor::orderby('department_name')->get();
        return view('set.constructor')->with(['constructor'=>$constructor]);
    }
    public function store()
    {
        $constructor = new Constructor;
        $constructor->department_name = Request::input('constructor_name');
        $constructor->department_abbr = Request::input('constructor_abbr');
        $constructor->department_name_ru = Request::input('constructor_name_ru');
        $constructor->save();
        return Redirect('constructor');
    }

    public function update(Request $request)
    {
        $constructor = DB::table('CONST_DEPARTMENT')
            ->where('department_id', Request::input('id'))
            ->update(['department_name' => Request::input('constructor_name'),'department_name_ru' => Request::input('constructor_name_ru'),'department_abbr' => Request::input('constructor_abbr')]);
        return Redirect('constructor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Constructor::where('department_id', '=', $id)->delete();
        return Redirect('constructor');
    }

}
