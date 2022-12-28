<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Blog;
use App\Models\Admin\Blogcate;
use Image;
use Str;
use Auth;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function blogs()
    {
        $blogs =  blog::where('user_id',Auth::user()->id)->where('status',1)->latest()->get();
        $count = 1;
        return view('admin.blog.index_blog',compact('blogs','count'));
    }
    public function userdeactiveBlog()
    {
        $blogs =  blog::where('user_id',Auth::user()->id)->where('status',0)->latest()->get();
        $count = 1;
        return view('admin.blog.index_blog',compact('blogs','count'));
    }

    public function index()
    {
        $blogs =  blog::where('status',1)->latest()->get();
        $count = 1;
        return view('admin.blog.index_blog',compact('blogs','count'));
    }

    public function create()
    {
        $blogcates =  blogcate::where('status',1)->latest()->get();
        return view('admin.blog.create_blog',compact('blogcates'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'title' => 'min:15|max:191',
            'description'=>'required',
            'slug'=>'required|unique:blogs|max:191',
        ]);

        // $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $request->slug);

        $blog = blog::create([

            'title'=>$request->title,
            'blogcate_id'=>$request->blogcate_id,
            'user_id'=>Auth::id(),
            'slug'=> $request->slug,
            'image'=>$request->image,
            'description'=>$request->description,
            'month'=> date("F-Y"),
            'meta_tag'=>$request->meta_tag,
            'meta_description'=>$request->meta_description,

        ]);
        $this->storeImage($blog);
        if($blog){
            return redirect()->back()->with('success', 'Blog Created Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }

    }

    //blog EDIT
    public function edit(blog $blog,Request $request)
    {
        $blogcates =  blogcate::all();
        $count = 1 ;

        return view('admin.blog.edit_blog',compact('blog','blogcates','count'));
    }


    //blog UPDATE

    public function update(blog $blog,Request $request)
    {
        $request->validate([
            'title' => 'min:15|max:191',
            'description'=>'required',
        ]);


         if($request->has('image')){
             if($request->old_image){
                 unlink('storage/app/public/'.$request->old_image);
             }
             $blog->update([
                 'image' => $request->image->store('admin/blog','public'),
             ]);
            $resize = Image::make('storage/app/public/'.$blog->image)->resize(550,320);
            $resize->save();
         }



        $blog->update([

            'title'=>$request->title,
            // 'slug'=> Str::slug($request->title).'-'.time(),
            // 'blogcate_id'=>$request->blogcate_id,
            // 'user_id'=> Auth::id(),
            // 'image'=>$request->image,
            'description'=>$request->description,
            'trend'=>$request->trend,
            'importent'=>$request->importent,
            'meta_tag'=>$request->meta_tag,
            'meta_description'=>$request->meta_description,

        ]);
        // $this->storeImage($blog);
        if($blog){
            return redirect()->back()->with('success', 'Blog Updated Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }

    }

    public function delete(blog $blog)
    {
        if($blog->image){
            unlink('storage/app/public/'.$blog->image);
        }
      
        $blog->delete();
        if($blog){
            return redirect()->back()->with('deletesuccess', 'Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    
    public function active(blog $blog)
    {
        $blog->update(['status' => 1]);
        if($blog){
            return redirect()->back()->with('success', 'Blog Activate Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    
    public function deactive(blog $blog)
    {
        $blog->update(['status' => 0]);
        if($blog){
            return redirect()->back()->with('success', 'Blog Deactivate Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    public function deactiveList()
    {
        $blogs =blog::where('status',0)->get();
        $count = 1;
        return view('admin.blog.deactive_blog',compact('blogs','count'));
    }

    public function activeList()
    {
        $blogs =blog::where('status',1)->get();
        return view('admin.blog.blog_deactive',compact('blogs'));
    }




    //PUBLIC FUNCTIONS
    // private function validateRequest()
    // {
        
    //     return request()->validate([
    //         'title'=>'required',
    //         'slug'=> 'required',
    //         'blogcate_id'=>'required',
    //         'quantity'=>'required',
           
    //         'price'=>'required',
    //         'description'=>'required',
            
    //     ]);
    // }


    private function storeImage($blog)
    {
        if(request()->hasFile('image')){
            $blog->update([
                'image' => request()->image->store('admin/blog','public'),
            ]);
            $resize = Image::make('storage/app/public/'.$blog->image)->resize(550,320);
            $resize->save();
        }
    }
}
