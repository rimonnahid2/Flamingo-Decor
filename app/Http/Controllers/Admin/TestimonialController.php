<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Testimonial;
use Image;
use Str;
use Auth;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $testimonial =  testimonial::where('status',1)->latest()->get();
        $count = 1;
        return view('admin.testimonial.index_testimonial',compact('testimonial','count'));
    }

    public function create()
    {
        return view('admin.testimonial.create_testimonial');
    }

    public function store(Request $request)
    {
        // return $request->all();
        // $request->validate([
        //     'name' => 'min:15|max:191',
        //     'description'=>'required',
        //     'slug'=>'required|unique:testimonial|max:191',
        // ]);

        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $request->name);

        $testimonial = testimonial::create([

            'name'=>$request->name,
            // 'user_id'=>Auth::id(),
            'slug'=> $slug.'-'.rand(1000,9999),
            'profession'=>$request->profession,
            'image'=>$request->image,
            'description'=>$request->description,

        ]);
        $this->storeImage($testimonial);
        if($testimonial){
            return redirect()->back()->with('success', 'testimonial Created Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }

    }

    //testimonial EDIT
    public function edit(testimonial $testimonial,Request $request)
    {
        $count = 1 ;
        return view('admin.testimonial.edit_testimonial',compact('testimonial','count'));
    }


    //testimonial UPDATE

    public function update(testimonial $testimonial,Request $request)
    {
        $request->validate([
            'name' => 'min:15|max:191',
            'description'=>'required',
        ]);


         if($request->has('image')){
             if($request->old_image){
                 unlink('storage/app/public/'.$request->old_image);
             }
             $testimonial->update([
                 'image' => $request->image->store('admin/testimonial','public'),
             ]);
            $resize = Image::make('storage/app/public/'.$testimonial->image)->resize(550,320);
            $resize->save();
         }



        $testimonial->update([

            'name'=>$request->name,
            'profession '=>$request->profession ,
            'description'=>$request->description,

        ]);
        // $this->storeImage($testimonial);
        if($testimonial){
            return redirect()->back()->with('success', 'testimonial Updated Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }

    }

    public function delete(testimonial $testimonial)
    {
        if($testimonial->image){
            unlink('storage/app/public/'.$testimonial->image);
        }
      
        $testimonial->delete();
        if($testimonial){
            return redirect()->back()->with('deletesuccess', 'Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    
    public function active(testimonial $testimonial)
    {
        $testimonial->update(['status' => 1]);
        if($testimonial){
            return redirect()->back()->with('success', 'testimonial Activate Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    
    public function deactive(testimonial $testimonial)
    {
        $testimonial->update(['status' => 0]);
        if($testimonial){
            return redirect()->back()->with('success', 'testimonial Deactivate Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    public function deactiveList()
    {
        $testimonial =testimonial::where('status',0)->get();
        $count = 1;
        return view('admin.testimonial.deactive_testimonial',compact('testimonial','count'));
    }

    public function activeList()
    {
        $testimonial =testimonial::where('status',1)->get();
        return view('admin.testimonial.testimonial_deactive',compact('testimonial'));
    }



    private function storeImage($testimonial)
    {
        if(request()->hasFile('image')){
            $testimonial->update([
                'image' => request()->image->store('admin/testimonial','public'),
            ]);
            $resize = Image::make('storage/app/public/'.$testimonial->image)->resize(550,320);
            $resize->save();
        }
    }
}
