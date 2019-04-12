<?php

namespace App\Http\Controllers;

use Request;
use App\Constructor;
use App\Method;
use DB;
class MethodController extends Controller
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
        $method = DB::table('V_CONST_METHOD')->orderby('method_code')->get();
        return view('set.method')->with(['method'=>$method]);
    }
    public function store()
    {
        $method = new Method;

        $method->method_name = Request::input('method_name');
        $method->method_name_ru = Request::input('method_name_ru');
        $method->parent_method_code = Request::input('parent_method_code');
        $method->save();
        return Redirect('method');
    }

    public function update(Request $request)
    {
        $method = DB::table('CONST_METHOD')
            ->where('method_code', Request::input('id'))
            ->update(['method_name' => Request::input('method_name'),'method_name_ru' => Request::input('method_name_ru'),'parent_method_code' => Request::input('parent_method_code')]);
        return Redirect('method');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Method::where('method_code', '=', $id)->delete();
        return Redirect('method');
    }
}
