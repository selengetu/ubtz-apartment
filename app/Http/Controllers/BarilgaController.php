<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constructor;
use App\Executor;
class BarilgaController extends Controller
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
        return view('barilga')->with(['constructor'=>$constructor,'executor'=>$executor]);
    }
}
