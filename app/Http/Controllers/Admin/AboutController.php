<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\About;
use Image;
use Str;
use Auth;

class AboutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function abouts()
    {
        $abouts =  about::where('user_id',Auth::user()->id)->where('status',1)->latest()->get();
        $count = 1;
        return view('admin.about.index_about',compact('abouts','count'));
    }
    public function userdeactiveabout()
    {
        $abouts =  about::where('user_id',Auth::user()->id)->where('status',0)->latest()->get();
        $count = 1;
        return view('admin.about.index_about',compact('abouts','count'));
    }

    public function index()
    {
        $abouts =  about::where('status',1)->latest()->get();
        $count = 1;
        return view('admin.about.index_about',compact('abouts','count'));
    }

    public function create()
    {
        return view('admin.about.create_about');
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'title' => 'min:15|max:191',
            'description'=>'required',
            'slug'=>'required|unique:abouts|max:191',
        ]);

        // $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $request->slug);

        $about = about::create([

            'title'=>$request->title,
            'user_id'=>Auth::id(),
            'slug'=> $request->slug,
            'image'=>$request->image,
            'description'=>$request->description,
            'meta_tag'=>$request->meta_tag,
            'meta_description'=>$request->meta_description,

        ]);
        $this->storeImage($about);
        if($about){
            return redirect()->route('index.about')->with('success', 'About Created Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }

    }

    //about EDIT
    public function edit(About $about,Request $request)
    {
        $count = 1 ;
        return view('admin.about.edit_about',compact('about','count'));
    }


    //about UPDATE

    public function update(About $about,Request $request)
    {
        $request->validate([
            'title' => 'min:15|max:191',
            'description'=>'required',
        ]);


         if($request->has('image')){
             if($request->old_image){
                 unlink('storage/app/public/'.$request->old_image);
             }
             $about->update([
                 'image' => $request->image->store('admin/about','public'),
             ]);
            $resize = Image::make('storage/app/public/'.$about->image)->resize(550,320);
            $resize->save();
         }



        $about->update([

            'title'=>$request->title,
            'description'=>$request->description,
            'meta_tag'=>$request->meta_tag,
            'meta_description'=>$request->meta_description,

        ]);
        // $this->storeImage($about);
        if($about){
            return redirect()->back()->with('success', 'About Updated Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }

    }

    public function delete(about $about)
    {
        if($about->image){
            unlink('storage/app/public/'.$about->image);
        }
      
        $about->delete();
        if($about){
            return redirect()->back()->with('success', 'Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    
    public function active(about $about)
    {
        $about->update(['status' => 1]);
        if($about){
            return redirect()->back()->with('success', 'about Activate Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    
    public function deactive(about $about)
    {
        $about->update(['status' => 0]);
        if($about){
            return redirect()->back()->with('success', 'about Deactivate Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    public function deactiveList()
    {
        $abouts =about::where('status',0)->get();
        $count = 1;
        return view('admin.about.deactive_about',compact('abouts','count'));
    }

    public function activeList()
    {
        $abouts =about::where('status',1)->get();
        return view('admin.about.about_deactive',compact('abouts'));
    }




    //PUBLIC FUNCTIONS
    // private function validateRequest()
    // {
        
    //     return request()->validate([
    //         'title'=>'required',
    //         'slug'=> 'required',
    //         'aboutcate_id'=>'required',
    //         'quantity'=>'required',
           
    //         'price'=>'required',
    //         'description'=>'required',
            
    //     ]);
    // }


    private function storeImage($about)
    {
        if(request()->hasFile('image')){
            $about->update([
                'image' => request()->image->store('admin/about','public'),
            ]);
            $resize = Image::make('storage/app/public/'.$about->image)->resize(550,320);
            $resize->save();
        }
    }
}
