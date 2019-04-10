<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constructor;
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
        $constructor->department_name = Request::input('department_name');
        $constructor->department_abbr = Request::input('department_abbr');
        $constructor->department_name_ru = Request::input('department_name_ru');
        $constructor->save();
        return Redirect('constructor');
    }

    public function update(Request $request)
    {
        $constructor = DB::table('SET_DEPARTMENT')
            ->where('department_id', Request::input('id'))
            ->update(['department_name' => Request::input('department_name'),'department_name_ru' => Request::input('department_name_ru'),'department_abbr' => Request::input('department_abbr')]);
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
