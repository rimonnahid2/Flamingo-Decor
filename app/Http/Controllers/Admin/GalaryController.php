<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Galary;
use App\Models\Admin\Galarycate;
use Image;
use Str;
use Auth;

class GalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function galaries()
    {
        $galaries =  galary::where('user_id',Auth::user()->id)->where('status',1)->latest()->get();
        $count = 1;
        return view('admin.galary.index_galary',compact('galaries','count'));
    }
    public function userdeactivegalary()
    {
        $galaries =  galary::where('user_id',Auth::user()->id)->where('status',0)->latest()->get();
        $count = 1;
        return view('admin.galary.index_galary',compact('galaries','count'));
    }

    public function index()
    {
        $galaries =  galary::where('status',1)->where('type',1)->latest()->get();
        $count = 1;
        return view('admin.galary.index_galary',compact('galaries','count'));
    }
    public function indexVideo()
    {
        $videos =  galary::where('status',1)->where('type',2)->latest()->get();
        $count = 1;
        return view('admin.galary.index_video',compact('videos','count'));
    }

    public function create()
    {
        $galarycates =  galarycate::where('status',1)->latest()->get();
        return view('admin.galary.create_galary',compact('galarycates'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'title' => 'min:15|max:191',
            'description'=>'required',
            'slug'=>'required|unique:galaries|max:191',
        ]);

        // $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $request->slug);

        $galary = galary::create([

            'title'=>$request->title,
            'galarycate_id'=>$request->galarycate_id,
            'user_id'=>Auth::id(),
            'slug'=> $request->slug,
            'image'=>$request->image,
            'description'=>$request->description,
            'month'=> date("F"),
            'year'=> date("Y"),
            'link'=>$request->link,
            'meta_tag'=>$request->meta_tag,
            'meta_description'=>$request->meta_description,

        ]);
        $this->storeImage($galary);
        if($galary){
            return redirect()->back()->with('success', 'galary Created Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }

    }

    //galary EDIT
    public function edit(galary $galary,Request $request)
    {
        $galarycates =  galarycate::all();
        $count = 1 ;

        return view('admin.galary.edit_galary',compact('galary','galarycates','count'));
    }


    //galary UPDATE

    public function update(galary $galary,Request $request)
    {
        $request->validate([
            'title' => 'min:15|max:191',
            'description'=>'required',
        ]);


         if($request->has('image')){
             if($request->old_image){
                 unlink('storage/app/public/'.$request->old_image);
             }
             $galary->update([
                 'image' => $request->image->store('admin/galary','public'),
             ]);
            $resize = Image::make('storage/app/public/'.$galary->image)->resize(550,320);
            $resize->save();
         }



        $galary->update([

            'title'=>$request->title,
            // 'slug'=> Str::slug($request->title).'-'.time(),
            'galarycate_id'=>$request->galarycate_id,
            // 'user_id'=> Auth::id(),
            // 'image'=>$request->image,
            'description'=>$request->description,
            'link'=>$request->link,
            'meta_tag'=>$request->meta_tag,
            'meta_description'=>$request->meta_description,

        ]);
        // $this->storeImage($galary);
        if($galary){
            return redirect()->back()->with('success', 'galary Updated Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }

    }

    public function delete(galary $galary)
    {
        if($galary->image){
            unlink('storage/app/public/'.$galary->image);
        }
      
        $galary->delete();
        if($galary){
            return redirect()->back()->with('deletesuccess', 'Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    
    public function active(galary $galary)
    {
        $galary->update(['status' => 1]);
        if($galary){
            return redirect()->back()->with('success', 'galary Activate Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    
    public function deactive(galary $galary)
    {
        $galary->update(['status' => 0]);
        if($galary){
            return redirect()->back()->with('success', 'galary Deactivate Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    public function deactiveList()
    {
        $galaries =galary::where('status',0)->get();
        $count = 1;
        return view('admin.galary.deactive_galary',compact('galaries','count'));
    }

    public function activeList()
    {
        $galaries =galary::where('status',1)->get();
        return view('admin.galary.galary_deactive',compact('galaries'));
    }





    public function createVideo()
    {
        $galarycates =  galarycate::where('status',1)->latest()->get();
        return view('admin.galary.create_video',compact('galarycates'));
    }




    //PUBLIC FUNCTIONS
    // private function validateRequest()
    // {
        
    //     return request()->validate([
    //         'title'=>'required',
    //         'slug'=> 'required',
    //         'galarycate_id'=>'required',
    //         'quantity'=>'required',
           
    //         'price'=>'required',
    //         'description'=>'required',
            
    //     ]);
    // }


    private function storeImage($galary)
    {
        if(request()->hasFile('image')){
            $galary->update([
                'image' => request()->image->store('admin/galary','public'),
            ]);
            // $resize = Image::make('storage/app/public/'.$galary->image)->resize(550,320);
            // $resize->save();
        }
    }
}
