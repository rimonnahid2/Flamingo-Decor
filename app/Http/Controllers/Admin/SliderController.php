<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Slider;
use Image;
use Str;

class SliderController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sliders = slider::latest()->get();
        $count = 1;
        return view('admin.slider.slider_manage',compact('sliders','count'));
    }

    public function create(Request $request)
    {
        $this->validateRequest();
        $slider = slider::create([
            'title'=> $request->title,
            'image'=> $request->image,
            'description'=> $request->description,
        ]);
        $this->storeImage($slider);
        if ($slider) {
            return redirect()->back()->with('success','Slider Stored Successfully.');
        }else{
            return redirect()->back()->with('wrong','Something went wrong');
        }
    }

    public function update(slider $slider ,Request $request)
    {
        $request->validate([
                'title'=>'required',
                'image'=>'',
        ]);
        if($request->has('image')){
            if($request->old_image){
                    unlink('storage/app/public/'.$request->old_image);
            }
            $slider->update([
                    'image' => $request->image->store('admin/slider','public'),
            ]);
            $resize = Image::make('storage/app/public/'.$slider->image)->resize(300,300);
            $resize->save();
        }
        $slider->update([
                'title' => $request->title,
                'description' => $request->description,
        ]);

        return redirect()->back()->with('success','slider Updated Successfully');

    }

    public function delete(slider $slider)
    {
        if($slider->image){
        unlink('storage/app/public/'.$slider->image);
        }
        $slider->delete();
          return redirect()->back()->with('deletesuccess','Deleted Successful');
    }



    //private methods
    private function validateRequest()
    {
        return request()->validate([
            'title'=>'required',
            // 'image'=>'required',
        ]);
    }

    private function storeImage($slider)
    {
        if(request()->file('image')){
            $slider->update([
                'image' => request()->image->store('admin/slider','public')
            ]);

            // $resize = Image::make('storage/app/public/'.$slider->image)->resize(300,300);
            // $resize->save();
        }
    }
}
