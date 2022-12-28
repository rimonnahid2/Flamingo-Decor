<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\News\News;
use App\Models\Admin\News\Newscate;
use Image;
use Str;
use Auth;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function news()
    {
        $news =  news::where('user_id',Auth::user()->id)->where('status',1)->latest()->get();
        $count = 1;
        return view('admin.news.index_news',compact('news','count'));
    }
    public function userdeactivenews()
    {
        $news =  news::where('user_id',Auth::user()->id)->where('status',0)->latest()->get();
        $count = 1;
        return view('admin.news.index_news',compact('news','count'));
    }

    public function index()
    {
        $news =  news::where('status',1)->latest()->get();
        $count = 1;
        return view('admin.news.index_news',compact('news','count'));
    }

    public function create()
    {
        $newscates =  newscate::where('status',1)->latest()->get();
        return view('admin.news.create_news',compact('newscates'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'title' => 'min:15|max:191',
            'description'=>'required',
            'slug'=>'required|unique:news|max:191',
        ]);

        // $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $request->slug);

        $news = news::create([

            'title'=>$request->title,
            'newscate_id'=>$request->newscate_id,
            'user_id'=>Auth::id(),
            'slug'=> $request->slug,
            'image'=>$request->image,
            'description'=>$request->description,
            'month'=> date("F-Y"),
            'meta_tag'=>$request->meta_tag,
            'meta_description'=>$request->meta_description,

        ]);
        $this->storeImage($news);
        if($news){
            return redirect()->route('index.news')->with('success', 'news Created Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }

    }

    //news EDIT
    public function edit(news $news,Request $request)
    {
        $newscates =  newscate::all();
        $count = 1 ;

        return view('admin.news.edit_news',compact('news','newscates','count'));
    }


    //news UPDATE

    public function update(news $news,Request $request)
    {
        $request->validate([
            'title' => 'min:15|max:191',
            'description'=>'required',
        ]);


         if($request->has('image')){
             if($request->old_image){
                 unlink('storage/app/public/'.$request->old_image);
             }
             $news->update([
                 'image' => $request->image->store('admin/news','public'),
             ]);
            $resize = Image::make('storage/app/public/'.$news->image)->resize(550,320);
            $resize->save();
         }



        $news->update([

            'title'=>$request->title,
            // 'slug'=> Str::slug($request->title).'-'.time(),
            // 'newscate_id'=>$request->newscate_id,
            // 'user_id'=> Auth::id(),
            // 'image'=>$request->image,
            'description'=>$request->description,
            'trend'=>$request->trend,
            'importent'=>$request->importent,
            'meta_tag'=>$request->meta_tag,
            'meta_description'=>$request->meta_description,

        ]);
        // $this->storeImage($news);
        if($news){
            return redirect()->back()->with('success', 'news Updated Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }

    }

    public function delete(news $news)
    {
        if($news->image){
            unlink('storage/app/public/'.$news->image);
        }
      
        $news->delete();
        if($news){
            return redirect()->back()->with('deletesuccess', 'Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    
    public function active(news $news)
    {
        $news->update(['status' => 1]);
        if($news){
            return redirect()->back()->with('success', 'news Activate Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    
    public function deactive(news $news)
    {
        $news->update(['status' => 0]);
        if($news){
            return redirect()->back()->with('success', 'news Deactivate Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    public function deactiveList()
    {
        $news =news::where('status',0)->get();
        $count = 1;
        return view('admin.news.deactive_news',compact('news','count'));
    }

    public function activeList()
    {
        $news =news::where('status',1)->get();
        return view('admin.news.news_deactive',compact('news'));
    }




    //PUBLIC FUNCTIONS
    // private function validateRequest()
    // {
        
    //     return request()->validate([
    //         'title'=>'required',
    //         'slug'=> 'required',
    //         'newscate_id'=>'required',
    //         'quantity'=>'required',
           
    //         'price'=>'required',
    //         'description'=>'required',
            
    //     ]);
    // }


    private function storeImage($news)
    {
        if(request()->hasFile('image')){
            $news->update([
                'image' => request()->image->store('admin/news','public'),
            ]);
            $resize = Image::make('storage/app/public/'.$news->image)->resize(550,320);
            $resize->save();
        }
    }
}
