<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\aboutmore;
use App\Models\Admin\about;
use Image;
use Str;

class AboutmoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(About $about)
    {
        $aboutmores = aboutmore::latest()->get();
        $count = 1;
        return view('admin.about.aboutmore',compact('aboutmores','count','about'));
    }
   public function create(Request $request)
    {
        $this->validateRequest();
        $aboutmore = aboutmore::create([
            'about_id'=> $request->about_id,
            'name'=> $request->name,
            'detail'=> $request->detail,
        ]);
        return redirect()->back()->with('success','aboutmore Stored Successfully.');
    }


    public function update(aboutmore $aboutmore ,Request $request)
    {
        $request->validate([
                'name'=>'required',
                'detail'=>'',
        ]);

        $aboutmore->update([
            'about_id'=> $request->about_id,
            'name'=> $request->name,
            'detail'=> $request->detail,
        ]);

        return redirect()->back()->with('success','aboutmore Updated Successfully');

    }

    public function delete(aboutmore $aboutmore)
    {
        // if($aboutmore->image){
        // unlink('storage/app/public/'.$aboutmore->image);
        // }
        $aboutmore->delete();
          return redirect()->back()->with('deletesuccess','Deleted Successful');
    }


    public function active(aboutmore $aboutmore)
    {
        $aboutmore->update(['status' => 1]);
        if($aboutmore){
            return redirect()->back()->with('success','This aboutmore activate successfully.');
        }else{
            return redirect()->back()->with('wrong','Something went wrong.');
        }
    }

    
    public function deactive(aboutmore $aboutmore)
    {
        $aboutmore->update(['status' => 0]);
        if($aboutmore){
            return redirect()->back()->with('success','This aboutmore deactive successfully.');
        }else{
            return redirect()->back()->with('wrong','Something went wrong.');
        }
    }



    //private methods
    private function validateRequest()
    {
        return request()->validate([
            'name'=>'required',
            // 'image'=>'required',
        ]);
    }
}
