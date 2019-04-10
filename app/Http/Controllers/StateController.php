<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constructor;
use App\State;
class StateController extends Controller
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
        return view('set.state')->with(['state'=>$state]);
    }
    public function store()
    {
        $state = new State;
        $state->state_name_mn = Request::input('state_name_mn');
        $state->state_name_ru = Request::input('state_name_ru');
        $state->save();
        return Redirect('executor');
    }

    public function update(Request $request)
    {
        $state = DB::table('SET_STATE')
            ->where('state_id', Request::input('id'))
            ->update(['state_name_mn' => Request::input('state_name_mn'),'state_name_ru' => Request::input('state_name_ru')]);
        return Redirect('state');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        State::where('state_id', '=', $id)->delete();
        return Redirect('state');
    }
}
