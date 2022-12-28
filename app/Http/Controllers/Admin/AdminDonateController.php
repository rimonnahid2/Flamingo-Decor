<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Donate;
use Image;
use Str;
use Auth;

class AdminDonateController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function donates()
    {
        $donates =  donate::where('user_id',Auth::user()->id)->where('status',1)->latest()->get();
        $count = 1;
        return view('admin.donate.index_donate',compact('donates','count'));
    }
    public function userdeactivedonate()
    {
        $donates =  donate::where('user_id',Auth::user()->id)->where('status',0)->latest()->get();
        $count = 1;
        return view('admin.donate.index_donate',compact('donates','count'));
    }

    public function index()
    {
        $donates =  donate::where('status',1)->latest()->get();
        $count = 1;
        return view('admin.donate.index_donate',compact('donates','count'));
    }

    // public function create()
    // {
    //     return view('admin.donate.create_donate');
    // }


    // //donate EDIT
    // public function edit(donate $donate,Request $request)
    // {
    //     $donatecates =  donatecate::all();
    //     $count = 1 ;

    //     return view('admin.donate.edit_donate',compact('donate','donatecates','count'));
    // }


    // //donate UPDATE

    // public function update(donate $donate,Request $request)
    // {
    //     $request->validate([
    //         'title' => 'min:15|max:191',
    //         'description'=>'required',
    //     ]);


    //      if($request->has('image')){
    //          if($request->old_image){
    //              unlink('storage/app/public/'.$request->old_image);
    //          }
    //          $donate->update([
    //              'image' => $request->image->store('admin/donate','public'),
    //          ]);
    //         $resize = Image::make('storage/app/public/'.$donate->image)->resize(550,320);
    //         $resize->save();
    //      }



    //     $donate->update([

    //         'title'=>$request->title,
    //         // 'slug'=> Str::slug($request->title).'-'.time(),
    //         // 'donatecate_id'=>$request->donatecate_id,
    //         // 'user_id'=> Auth::id(),
    //         // 'image'=>$request->image,
    //         'description'=>$request->description,
    //         'trend'=>$request->trend,
    //         'importent'=>$request->importent,
    //         'meta_tag'=>$request->meta_tag,
    //         'meta_description'=>$request->meta_description,

    //     ]);
    //     // $this->storeImage($donate);
    //     if($donate){
    //         return redirect()->back()->with('success', 'donate Updated Successfully');
    //     }else{
    //         return redirect()->back()->with('wrong', 'Something went wrong!!');
    //     }

    // }

    public function delete(donate $donate)
    {
        if($donate->image){
            unlink('storage/app/public/'.$donate->image);
        }
      
        $donate->delete();
        if($donate){
            return redirect()->back()->with('success', 'Donate Deleted Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    
    public function active(donate $donate)
    {
        $donate->update(['status' => 1]);
        if($donate){
            return redirect()->back()->with('success', 'donate Activate Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }    
    public function confirm(donate $donate)
    {
        $donate->update(['status' => 5]);
        if($donate){
            return redirect()->back()->with('success', 'Confirm Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    
    public function deactive(donate $donate)
    {
        $donate->update(['status' => 0]);
        if($donate){
            return redirect()->back()->with('success', 'donate Deactivate Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    public function deactiveList()
    {
        $donates =donate::where('status',0)->get();
        $count = 1;
        return view('admin.donate.deactive_donate',compact('donates','count'));
    }

    public function activeList()
    {
        $donates =donate::where('status',5)->get();
        $count = 1;
        return view('admin.donate.active_donate',compact('donates','count'));
    }



}
