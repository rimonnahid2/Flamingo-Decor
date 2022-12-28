<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Website;
use App\Models\User;
use Image;
use Str;

class WebsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $websites = website::latest()->get();
        $users = User::latest()->get();
        $count = 1;
        return view('admin.product.website_manage',compact('websites','users','count'));
    }
   public function create(Request $request)
    {
        $this->validateRequest();
        $website = website::create([
            'name'=> $request->name,
            'user_id'=> $request->user_id,
            'slug'=> Str::slug($request->name).'-'.time(),
            'image'=> $request->image,
        ]);
        $this->storeImage($website);
        return redirect()->back()->with('success','website Stored Successfully.');
    }


    public function update(website $website ,Request $request)
    {
        $request->validate([
                'name'=>'required',
                'image'=>'',
        ]);
        if($request->has('image')){
            if($request->old_image){
                    unlink('storage/app/public/'.$request->old_image);
            }
            $website->update([
                    'image' => $request->image->store('admin/website','public'),
            ]);
            $resize = Image::make('storage/app/public/'.$website->image)->resize(300,120);
            $resize->save();
        }
        $website->update([
                'name' => $request->name,
                'slug'=>Str::slug($request->name).'-'.time(),
        ]);

        return redirect()->back()->with('success','website Updated Successfully');

    }

    public function delete(website $website)
    {
        // if($website->image){
        // unlink('storage/app/public/'.$website->image);
        // }
        $website->delete();
        return redirect()->back()->with('wrong','Deleted Successful');
    }


    public function active(website $website)
    {
        $website->update(['status' => 1]);
        if($website){
            return redirect()->back()->with('success','This website activate successfully.');
        }else{
            return redirect()->back()->with('wrong','Something went wrong.');
        }
    }

    
    public function deactive(website $website)
    {
        $website->update(['status' => 0]);
        if($website){
            return redirect()->back()->with('success','This website deactive successfully.');
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

   private function storeImage($website)
    {
        if(request()->hasFile('image')){
            $website->update([
                'image' => request()->image->store('admin/website','public'),
            ]);

            $resize = Image::make('storage/app/public/'.$website->image)->resize(300,120);
            $resize->save();
        }
    }
}
