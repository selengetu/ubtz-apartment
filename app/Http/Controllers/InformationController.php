<?php

namespace App\Http\Controllers;

use Request;
use App\Information;
use App\Informationtype;
use DB;
use Session;
use Image;
use Illuminate\Support\Facades\Storage;
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
        $information = DB::table('V_information')->orderby('information_name')->get();
        $type = Informationtype::orderby('type_name')->get();
        return view('information')->with(['information'=>$information,'type'=>$type]);
    }

    public function store()
    {

        $inf= new Information();
        $inf->information_type = Request::input('information_type');
        $inf->information_content = Request::input('information_content');
        $inf->end_date = Request::input('end_date');
        $inf->add_date = Request::input('add_date');
        if (Request::hasFile('image')) {
            $file = request()->file('image');
            $filenamewithextension = $file->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $file->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            Storage::put('profile_images/inf/'. $filenametostore, fopen($file, 'r+'));

            //Resize image here
            $thumbnailpath = public_path('profile_images/inf/'.$filenametostore);

            $img1 = Image::make($file->getRealPath())->resize(400, 150, function($constraint) {
                $constraint->aspectRatio();
            });

            $img1->save($thumbnailpath);
            $imgpath = public_path('profile_images/inf/'.$filenametostore);
            $img = Image::make($file->getRealPath())->save($filenametostore);
            $img->save($imgpath);
            $inf ->img_path =$filenametostore;
        }
        $inf->save();
        return Redirect('information');
    }

    public function update(Request $request)
    {

        $information= DB::table('INFORMATION')
            ->where('information_id', Request::input('id'))
            ->update(['information_type' => Request::input('information_type')
                ,'information_content' => Request::input('information_content'),'end_date' => Request::input('end_date')]);

        if (Request::hasFile('image')) {
            $file = request()->file('image');
            $filenamewithextension = $file->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $file->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            Storage::put('profile_images/inf/'. $filenametostore, fopen($file, 'r+'));

            //Resize image here
            $thumbnailpath = public_path('profile_images/inf/'.$filenametostore);

            $img1 = Image::make($file->getRealPath())->resize(400, 150, function($constraint) {
                $constraint->aspectRatio();
            });

            $img1->save($thumbnailpath);
            $imgpath = public_path('profile_images/inf/'.$filenametostore);
            $img = Image::make($file->getRealPath())->save($filenametostore);
            $img->save($imgpath);
            $process = DB::table('Information')
                ->where('information_id', Request::input('id'))
                ->update(['img_path' => $filenametostore]);
        }
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
