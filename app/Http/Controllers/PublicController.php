<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Admin\Schedule;
use App\Models\Admin\Centre;
use App\Models\Admin\Blog;
use App\Models\Admin\Faq;
use App\Models\Admin\Setting;
use App\Models\User\Contact;
use App\Models\Admin\About;
use App\Models\Admin\Course;
use App\Models\Admin\Product;
use App\Models\Admin\Website;


class PublicController extends Controller
{
    
    public function index()
    {
        $products = Product::where('status',1)->latest()->paginate(8);
        $websites = Website::where('status',1)->latest()->limit(20)->get();
        $blogs = Blog::where('status',1)->latest()->limit(3)->get();
        $top_1 = Product::where('top_1',1)->where('status',1)->first();
        $offers = Product::where('offer',1)->where('status',1)->latest()->limit(2)->get();
        $trend = Product::where('trend',1)->where('status',1)->latest()->limit(9)->get();
        $today_offer = Product::where('today_offer',1)->where('status',1)->latest()->limit(2)->get();
        $daily_offer = Product::where('today_offer',1)->where('status',1)->latest()->limit(8)->get();
        $hot_deal = Product::where('hot_deal',1)->where('status',1)->latest()->limit(2)->get();
        return view('home',compact('products','top_1','offers','trend','today_offer','daily_offer','hot_deal','blogs','websites'));
    }

    public function blogSingle($slug)
    {
        $blog = Blog::where('slug',$slug)->first();
        $relatedblog = Blog::where('blogcate_id', $blog->blogcate_id)->where('slug', '!=', $slug)->get();
        return view('user.blog.single_blog',compact('blog','relatedblog'));
    }
    public function productSingle($slug)
    {
        $product = Product::where('slug',$slug)->first();
        $relatedproduct = Product::where('category_id', $product->category_id)->where('slug', '!=', $slug)->get();
        return view('user.product.single_product',compact('product','relatedproduct'));
    }

    public function blogs()
    {
        $blogs = Blog::where('status',1)->latest()->get();
        return view('user.blog.blogs',compact('blogs'));
    }

    public function courses()
    {
        $courses = Course::where('status',1)->latest()->get();
        return view('user.course.courses',compact('courses'));
    }

    public function courseSingle($slug)
    {
        $course = Course::where('slug',$slug)->first();
        return view('user.course.sinlge_course',compact('course'));
    }
    public function courseOrder(Request $request)
    {
            $result =  $request->package_id;
            $result_explode = explode('|', $result);
        return "Model: ". $result_explode[0]."<br />"."Colour: ". $result_explode[1]."<br />";
    }

    public function faqs()
    {
        $faqs = Faq::where('status',1)->latest()->get();
        return view('user.faqs',compact('faqs'));
    }

    public function about()
    {
        $about = About::first();
        return view('user.about',compact('about'));
    }



    public function contact()
    {
        $setting = Setting::first();
        return view('user.contact',compact('setting'));
    }

    public function contactCreate(Request $request)
    {
       // return $request->all();
        $data = $request->validate([

            'name'=>'max:191',
            'phone'=>'max:191',
            'email'=>'max:191',
            'message'=>'',
            'status'=>'',

        ]);

        $contact = Contact::create($data);
        if ($contact) {

            $details = [
                'name'=>$contact->name,
                'email'=>$contact->email,
                'phone'=>$contact->phone,
            ];

            \Mail::to($request->email)->send(new \App\Mail\MyMail($details));
            return redirect()->back()->with('success','Your message send successfully');
            // code...
        }else{

            return redirect()->back()->with('wrong','Something is wrong.please fillup form properly.');
        }
    }



    public function fetchSchedule($id){
        $schedule = Schedule::where('centre_id',$id)->get();
        return json_encode($schedule);
    }
}
