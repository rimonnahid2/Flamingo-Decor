<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Teamcate;
use App\Models\User;
use Image;
use Str;

class TeamcateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $teamcates = teamcate::latest()->get();
        $users = User::latest()->get();
        $count = 1;
        return view('admin.team.teamtype_manage',compact('teamcates','users','count'));
    }
   public function create(Request $request)
    {
        $this->validateRequest();
        $teamcate = teamcate::create([
            'name'=> $request->name,
            'user_id'=> $request->user_id,
            'slug'=> Str::slug($request->name).'-'.time(),
            'image'=> $request->image,
        ]);
        $this->storeImage($teamcate);
        return redirect()->back()->with('success','teamcate Stored Successfully.');
    }


    public function update(teamcate $teamcate ,Request $request)
    {
        $request->validate([
                'name'=>'required',
                'user_id'=>'required',
                'image'=>'',
        ]);
        if($request->has('image')){
            if($request->old_image){
                    unlink('storage/app/public/'.$request->old_image);
            }
            $teamcate->update([
                    'image' => $request->image->store('admin/teamcate','public'),
            ]);
            $resize = Image::make('storage/app/public/'.$teamcate->image)->resize(300,300);
            $resize->save();
        }
        $teamcate->update([
                'name' => $request->name,
                'user_id' => $request->user_id,
                'slug'=>Str::slug($request->name).'-'.time(),
        ]);

        return redirect()->back()->with('success','teamcate Updated Successfully');

    }

    public function delete(teamcate $teamcate)
    {
        // if($teamcate->image){
        // unlink('storage/app/public/'.$teamcate->image);
        // }
        $teamcate->delete();
        return redirect()->back()->with('wrong','Deleted Successful');
    }


    public function active(teamcate $teamcate)
    {
        $teamcate->update(['status' => 1]);
        if($teamcate){
            return redirect()->back()->with('success','This teamcate activate successfully.');
        }else{
            return redirect()->back()->with('wrong','Something went wrong.');
        }
    }

    
    public function deactive(teamcate $teamcate)
    {
        $teamcate->update(['status' => 0]);
        if($teamcate){
            return redirect()->back()->with('success','This teamcate deactive successfully.');
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

   private function storeImage($teamcate)
    {
        if(request()->hasFile('image')){
            $teamcate->update([
                'image' => request()->image->store('admin/teamcate','public'),
            ]);

            $resize = Image::make('storage/app/public/'.$teamcate->image)->resize(300,300);
            $resize->save();
        }
    }
}
