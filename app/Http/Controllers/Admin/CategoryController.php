<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\User;
use Image;
use Str;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = category::latest()->get();
        $users = User::latest()->get();
        $count = 1;
        return view('admin.product.category_manage',compact('categories','users','count'));
    }
   public function create(Request $request)
    {
        $this->validateRequest();
        $category = category::create([
            'name'=> $request->name,
            'user_id'=> $request->user_id,
            'slug'=> Str::slug($request->name).'-'.time(),
            'image'=> $request->image,
        ]);
        $this->storeImage($category);
        return redirect()->back()->with('success','category Stored Successfully.');
    }


    public function update(category $category ,Request $request)
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
            $category->update([
                    'image' => $request->image->store('admin/category','public'),
            ]);
            $resize = Image::make('storage/app/public/'.$category->image)->resize(300,300);
            $resize->save();
        }
        $category->update([
                'name' => $request->name,
                'user_id' => $request->user_id,
                'slug'=>Str::slug($request->name).'-'.time(),
        ]);

        return redirect()->back()->with('success','category Updated Successfully');

    }

    public function delete(category $category)
    {
        // if($category->image){
        // unlink('storage/app/public/'.$category->image);
        // }
        $category->delete();
        return redirect()->back()->with('wrong','Deleted Successful');
    }


    public function active(category $category)
    {
        $category->update(['status' => 1]);
        if($category){
            return redirect()->back()->with('success','This category activate successfully.');
        }else{
            return redirect()->back()->with('wrong','Something went wrong.');
        }
    }

    
    public function deactive(category $category)
    {
        $category->update(['status' => 0]);
        if($category){
            return redirect()->back()->with('success','This category deactive successfully.');
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

   private function storeImage($category)
    {
        if(request()->hasFile('image')){
            $category->update([
                'image' => request()->image->store('admin/category','public'),
            ]);

            $resize = Image::make('storage/app/public/'.$category->image)->resize(300,300);
            $resize->save();
        }
    }
}
