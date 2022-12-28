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
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth' ,'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::where('status',1)->latest()->paginate(8);
        $websites = Website::where('status',1)->latest()->get();
        $blogs = Blog::where('status',1)->latest()->limit(3)->get();
        $top_1 = Product::where('top_1',1)->where('status',1)->first();
        $offers = Product::where('offer',1)->where('status',1)->latest()->limit(2)->get();
        $trend = Product::where('trend',1)->where('status',1)->latest()->get();
        $today_offer = Product::where('today_offer',1)->where('status',1)->latest()->limit(2)->get();
        $daily_offer = Product::where('today_offer',1)->where('status',1)->latest()->limit(8)->get();
        $hot_deal = Product::where('hot_deal',1)->where('status',1)->latest()->limit(2)->get();
        return view('home',compact('products','top_1','offers','trend','today_offer','daily_offer','hot_deal','blogs','websites'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
