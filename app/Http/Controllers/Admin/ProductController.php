<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Subcate;
use App\Models\Admin\Website;
use App\Models\Admin\Product;
use Image;
use Str;
use Auth;


class ProductController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function products()
    {
        $products =  product::where('user_id',Auth::user()->id)->where('status',1)->latest()->get();
        $count = 1;
        return view('admin.product.index_product',compact('products','count'));
    }
    public function userdeactiveproduct()
    {
        $products =  product::where('user_id',Auth::user()->id)->where('status',0)->latest()->get();
        $count = 1;
        return view('admin.product.index_product',compact('products','count'));
    }

    public function index()
    {
        $products =  product::where('status',1)->latest()->get();
        $count = 1;
        return view('admin.product.index_product',compact('products','count'));
    }

    public function create()
    {
        $categories =  Category::where('status',1)->latest()->get();
        $subcates =  Subcate::where('status',1)->latest()->get();
        $websites =  Website::where('status',1)->latest()->get();
        return view('admin.product.create_product',compact('categories','subcates','websites'));
    }


    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'title' => 'min:15|max:191',
            'description'=>'required',
            'slug'=>'required|unique:products|max:191',
        ]);

        // $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $request->slug);

        $product = product::create([

            'title'=>$request->title,
            'category_id'=>$request->category_id,
            'subcate_id'=>$request->subcate_id,
            'website_id'=>$request->website_id,
            'user_id'=>Auth::id(),
            'slug'=> $request->slug,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'summary'=>$request->summary,
            'link'=>$request->link,
            'shipping_info'=>$request->shipping_info,
            'note'=>$request->note,
            'image'=>$request->image,
            'best_rated'=>$request->best_rated,
            'slider'=>$request->slider,
            'hot_deal'=>$request->hot_deal,
            'trend'=>$request->trend,
            'top_1'=>$request->top_1,
            'offer'=>$request->offer,
            'today_offer'=>$request->today_offer,
            'meta_tag'=>$request->meta_tag,
            'description'=>$request->description,
            'meta_description'=>$request->meta_description,

        ]);
        $this->storeImage($product);
        if($product){
            return redirect()->back()->with('success', 'product Created Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }

    }

    //product EDIT
    public function edit(product $product,Request $request)
    {

        $categories =  Category::where('status',1)->latest()->get();
        $subcates =  Subcate::where('status',1)->latest()->get();
        $websites =  Website::where('status',1)->latest()->get();
        $count = 1 ;

        return view('admin.product.edit_product',compact('categories','subcates','websites','count','product'));
    }


    //PRODUCT UPDATE

    public function update(Product $product,Request $request)
    {
        $request->validate([
            'title' => 'min:15|max:191',
            'description'=>'required',
        ]);


         if($request->has('image')){
             if($request->old_image){
                 unlink('storage/app/public/'.$request->old_image);
             }
             $product->update([
                 'image' => $request->image->store('admin/product','public'),
             ]);
            // $resize = Image::make('storage/app/public/'.$product->image)->resize(550,320);
            // $resize->save();
         }



        $product->update([

            'title'=>$request->title,
            'category_id'=>$request->category_id,
            'subcate_id'=>$request->subcate_id,
            'website_id'=>$request->website_id,
            'user_id'=>Auth::id(),
            // 'slug'=> $request->slug,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'summary'=>$request->summary,
            'link'=>$request->link,
            'shipping_info'=>$request->shipping_info,
            'note'=>$request->note,
            // 'image'=>$request->image,
            'best_rated'=>$request->best_rated,
            'slider'=>$request->slider,
            'hot_deal'=>$request->hot_deal,
            'trend'=>$request->trend,
            'top_1'=>$request->top_1,
            'offer'=>$request->offer,
            'today_offer'=>$request->today_offer,
            'meta_tag'=>$request->meta_tag,
            'description'=>$request->description,
            'meta_description'=>$request->meta_description,

        ]);
        // $this->storeImage($product);
        if($product){
            return redirect()->back()->with('success', 'product Updated Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }

    }

    public function delete(product $product)
    {
        if($product->image){
            unlink('storage/app/public/'.$product->image);
        }
      
        $product->delete();
        if($product){
            return redirect()->back()->with('deletesuccess', 'Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    
    public function active(product $product)
    {
        $product->update(['status' => 1]);
        if($product){
            return redirect()->back()->with('success', 'product Activate Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    
    public function deactive(product $product)
    {
        $product->update(['status' => 0]);
        if($product){
            return redirect()->back()->with('success', 'product Deactivate Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }

    public function deactiveList()
    {
        $products =product::where('status',0)->get();
        $count = 1;
        return view('admin.product.deactive_product',compact('products','count'));
    }

    public function activeList()
    {
        $products =product::where('status',1)->get();
        return view('admin.product.product_deactive',compact('products'));
    }




    //PUBLIC FUNCTIONS
    // private function validateRequest()
    // {
        
    //     return request()->validate([
    //         'title'=>'required',
    //         'slug'=> 'required',
    //         'category_id'=>'required',
    //         'quantity'=>'required',
           
    //         'price'=>'required',
    //         'description'=>'required',
            
    //     ]);
    // }


    private function storeImage($product)
    {
        if(request()->hasFile('image')){
            $product->update([
                'image' => request()->image->store('admin/product','public'),
            ]);
            // $resize = Image::make('storage/app/public/'.$product->image)->resize(550,320);
            // $resize->save();
        }
    }
}
