<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\News\Newscate;
use App\Models\User;
use Image;
use Str;

class NewscateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $newscates = newscate::latest()->get();
        $users = User::latest()->get();
        $count = 1;
        return view('admin.news.newscategory_manage',compact('newscates','users','count'));
    }
   public function create(Request $request)
    {
        $this->validateRequest();
        $newscate = newscate::create([
            'name'=> $request->name,
            'user_id'=> $request->user_id,
            'slug'=> Str::slug($request->name).'-'.time(),
            'image'=> $request->image,
        ]);
        $this->storeImage($newscate);
        return redirect()->back()->with('success','newscate Stored Successfully.');
    }


    public function update(newscate $newscate ,Request $request)
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
            $newscate->update([
                    'image' => $request->image->store('admin/newscate','public'),
            ]);
            $resize = Image::make('storage/app/public/'.$newscate->image)->resize(300,300);
            $resize->save();
        }
        $newscate->update([
                'name' => $request->name,
                'user_id' => $request->user_id,
                'slug'=>Str::slug($request->name).'-'.time(),
        ]);

        return redirect()->back()->with('success','newscate Updated Successfully');

    }

    public function delete(newscate $newscate)
    {
        // if($newscate->image){
        // unlink('storage/app/public/'.$newscate->image);
        // }
        $newscate->delete();
        return redirect()->back()->with('wrong','Deleted Successful');
    }


    public function active(newscate $newscate)
    {
        $newscate->update(['status' => 1]);
        if($newscate){
            return redirect()->back()->with('success','This newscate activate successfully.');
        }else{
            return redirect()->back()->with('wrong','Something went wrong.');
        }
    }

    
    public function deactive(newscate $newscate)
    {
        $newscate->update(['status' => 0]);
        if($newscate){
            return redirect()->back()->with('success','This newscate deactive successfully.');
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

   private function storeImage($newscate)
    {
        if(request()->hasFile('image')){
            $newscate->update([
                'image' => request()->image->store('admin/newscate','public'),
            ]);

            $resize = Image::make('storage/app/public/'.$newscate->image)->resize(300,300);
            $resize->save();
        }
    }
}
