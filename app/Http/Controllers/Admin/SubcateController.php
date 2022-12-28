<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Subcate;
use App\Models\User;
use Image;
use Str;
use Auth;


class SubcateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::latest()->get();
        $subcates = Subcate::latest()->get();
        $users = User::latest()->get();
        $count = 1;
        return view('admin.product.subcategory_manage',compact('categories','subcates','users','count'));
    }
   public function create(Request $request)
    {
        $this->validateRequest();
        $subcate = subcate::create([
            'name'=> $request->name,
            'category_id'=> $request->category_id,
            'user_id'=> Auth::id(),
            'slug'=> Str::slug($request->name).'-'.time(),
            'image'=> $request->image,
        ]);
        $this->storeImage($subcate);
        return redirect()->back()->with('success','subcate Stored Successfully.');
    }


    public function update(subcate $subcate ,Request $request)
    {
        $request->validate([
                'name'=>'required',
                'image'=>'',
        ]);
        if($request->has('image')){
            if($request->old_image){
                    unlink('storage/app/public/'.$request->old_image);
            }
            $subcate->update([
                    'image' => $request->image->store('admin/subcate','public'),
            ]);
            $resize = Image::make('storage/app/public/'.$subcate->image)->resize(300,300);
            $resize->save();
        }
        $subcate->update([
                'name' => $request->name,
                'user_id' => Auth::id(),
                'category_id' =>$request->category_id,
                'slug'=>Str::slug($request->name).'-'.time(),
        ]);

        return redirect()->back()->with('success','subcate Updated Successfully');

    }

    public function delete(subcate $subcate)
    {
        // if($subcate->image){
        // unlink('storage/app/public/'.$subcate->image);
        // }
        $subcate->delete();
        return redirect()->back()->with('success','Deleted Successful');
    }


    public function active(subcate $subcate)
    {
        $subcate->update(['status' => 1]);
        if($subcate){
            return redirect()->back()->with('success','This subcate activate successfully.');
        }else{
            return redirect()->back()->with('wrong','Something went wrong.');
        }
    }

    
    public function deactive(subcate $subcate)
    {
        $subcate->update(['status' => 0]);
        if($subcate){
            return redirect()->back()->with('success','This subcate deactive successfully.');
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

   private function storeImage($subcate)
    {
        if(request()->hasFile('image')){
            $subcate->update([
                'image' => request()->image->store('admin/subcate','public'),
            ]);

            $resize = Image::make('storage/app/public/'.$subcate->image)->resize(300,300);
            $resize->save();
        }
    }
}
