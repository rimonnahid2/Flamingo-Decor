<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Galarycate;
use App\Models\User;
use Image;
use Str;

class GalarycateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $galarycates = galarycate::latest()->get();
        $users = User::latest()->get();
        $count = 1;
        return view('admin.galary.galarycate_manage',compact('galarycates','count','users'));
    }
   public function create(Request $request)
    {
        // return $request->user_id;
        $this->validateRequest();
        $galarycate = Galarycate::create([
            'user_id'=> $request->user_id,
            'name'=> $request->name,
            'slug'=> Str::slug($request->name).'-'.time(),
            'image'=> $request->image,
        ]);
        $this->storeImage($galarycate);
        return redirect()->back()->with('success','galarycate Stored Successfully.');
    }


    public function update(galarycate $galarycate ,Request $request)
    {
        $request->validate([
                'name'=>'required',
                'image'=>'',
        ]);
        if($request->has('image')){
            if($request->old_image){
                unlink('storage/app/public/'.$request->old_image);
            }
            $galarycate->update([
                'image' => $request->image->store('admin/galarycate','public'),
            ]);
            $resize = Image::make('storage/app/public/'.$galarycate->image)->resize(300,300);
            $resize->save();
        }
        $galarycate->update([
            'name' => $request->name,
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success','galarycate Updated Successfully');

    }

    public function delete(galarycate $galarycate)
    {
        // if($galarycate->image){
        // unlink('storage/app/public/'.$galarycate->image);
        // }
        $galarycate->delete();
          return redirect()->back()->with('success','Deleted Successful');
    }


    public function active(galarycate $galarycate)
    {
        $galarycate->update(['status' => 1]);
        if($galarycate){
            return redirect()->back()->with('success','This galarycate activate successfully.');
        }else{
            return redirect()->back()->with('wrong','Something went wrong.');
        }
    }

    
    public function deactive(galarycate $galarycate)
    {
        $galarycate->update(['status' => 0]);
        if($galarycate){
            return redirect()->back()->with('success','This galarycate deactive successfully.');
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

   private function storeImage($galarycate)
    {
        if(request()->hasFile('image')){
            $galarycate->update([
                'image' => request()->image->store('admin/galarycate','public'),
            ]);

            $resize = Image::make('storage/app/public/'.$galarycate->image)->resize(300,300);
            $resize->save();
        }
    }
}
