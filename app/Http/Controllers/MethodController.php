<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constructor;
use App\Method;
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
        $method = Method::orderby('method_code')->get();
        return view('set.method')->with(['method'=>$method]);
    }
    public function store()
    {
        $method = new State;
        $method->method_code = Request::input('state_name_mn');
        $method->method_name = Request::input('state_name_ru');
        $method->method_name_ru = Request::input('state_name_ru');
        $method->save();
        return Redirect('executor');
    }

    public function update(Request $request)
    {
        $method = DB::table('SET_METHOD')
            ->where('method_code', Request::input('id'))
            ->update(['method_name' => Request::input('method_name'),'method_name_ru' => Request::input('method_name_ru')]);
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
