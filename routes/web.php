<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogcateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcateController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\AdminDonateController;
use App\Http\Controllers\User\ProfileController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from Rimon Nahid',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('5001000junkemail@gmail.com')->send(new \App\Mail\MyMail($details));
   
    dd("Email is Sent.");
});



Route::get('/test', function () {
    return view('test');
});
Route::get('/layouts', function () {
    return view('layouts.app');
});
Route::get('/', function () {
    return view('welcome');
});

//BASIC MENU
Route::get('/', [PublicController::class, 'index'])->name('/');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/blogs', [PublicController::class, 'blogs'])->name('blogs');
Route::get('/faqs', [PublicController::class, 'faqs'])->name('faqs');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/blog/{slug}', [PublicController::class, 'blogSingle'])->name('single.blog');
Route::get('/product/{slug}', [PublicController::class, 'productSingle'])->name('single.product');

//change pass
Route::get('change-password', [ProfileController::class, 'editPassword']);
Route::post('change-password', [ProfileController::class, 'updatePassword'])->name('change.password');

Route::post('/contact-create', [PublicController::class, 'contactCreate'])->name('contact.create');

Auth::routes(['verify' => true]);


Route::get('/profile/{user}', [ProfileController::class, 'profile'])->name('user.profile');
Route::post('/update-user/{user}', [ProfileController::class, 'update'])->name('update.user');


Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/contact-messages', [AdminController::class, ''])->name('contact.messages');

    //Faq ROUTES
    Route::get('/faq-list', [FaqController::class, 'index'])->name('admin.faq');
    Route::post('/create/faq', [FaqController::class, 'create'])->name('create.faq');
    Route::post('/update/faq/{faq}', [FaqController::class, 'update'])->name('update.faq');
    Route::get('/delete/faq/{faq}', [FaqController::class, 'delete'])->name('delete.faq');
    Route::get('/active-faq/{faq}', [FaqController::class, 'active'])->name('active.faq');
    Route::get('/deactive-faq/{faq}', [FaqController::class, 'deactive'])->name('deactive.faq');
    Route::get('/deactive-faq-list', [FaqController::class, 'deactiveList'])->name('deactive.faq.list');

    //BLOG ROUTES
    Route::get('/list-blog', [BlogController::class, 'index'])->name('index.blog');
    Route::get('/create-blog', [BlogController::class, 'create'])->name('create.blog');
    Route::post('/store-blog', [BlogController::class, 'store'])->name('store.blog');
    Route::get('/edit-blog/{blog}', [BlogController::class, 'edit'])->name('edit.blog');
    Route::post('/update-blog/{blog}', [BlogController::class, 'update'])->name('update.blog');
    Route::get('/delete-blog/{blog}', [BlogController::class, 'delete'])->name('delete.blog');
    Route::get('/active-blog/{blog}', [BlogController::class, 'active'])->name('active.blog');
    Route::get('/deactive-blog/{blog}', [BlogController::class, 'deactive'])->name('deactive.blog');
    Route::get('/deactive-blog-list', [BlogController::class, 'deactiveList'])->name('deactive.blog.list');

    //BLOGCATE ROUTES
    Route::get('/blogcate', [BlogcateController::class, 'index'])->name('admin.blogcate');
    Route::post('/create/blogcate', [BlogcateController::class, 'create'])->name('create.blogcate');
    Route::post('/update/blogcate/{blogcate}', [BlogcateController::class, 'update'])->name('update.blogcate');
    Route::get('/delete/blogcate/{blogcate}', [BlogcateController::class, 'delete'])->name('delete.blogcate');
    Route::get('/active-blogcate/{blogcate}', [BlogcateController::class, 'active'])->name('active.blogcate');
    Route::get('/deactive-blogcate/{blogcate}', [BlogcateController::class, 'deactive'])->name('deactive.blogcate');
    Route::get('/deactive-blogcate-list', [BlogcateController::class, 'deactiveList'])->name('deactive.blogcate.list');


    //CATEGORY ROUTES
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('/create/category', [CategoryController::class, 'create'])->name('create.category');
    Route::post('/update/category/{category}', [CategoryController::class, 'update'])->name('update.category');
    Route::get('/delete/category/{category}', [CategoryController::class, 'delete'])->name('delete.category');
    Route::get('/active-category/{category}', [CategoryController::class, 'active'])->name('active.category');
    Route::get('/deactive-category/{category}', [CategoryController::class, 'deactive'])->name('deactive.category');
    Route::get('/deactive-category-list', [CategoryController::class, 'deactiveList'])->name('deactive.category.list');


    //SUBCATE ROUTES
    Route::get('/subcate', [SubcateController::class, 'index'])->name('admin.subcate');
    Route::post('/create/subcate', [SubcateController::class, 'create'])->name('create.subcate');
    Route::post('/update/subcate/{subcate}', [SubcateController::class, 'update'])->name('update.subcate');
    Route::get('/delete/subcate/{subcate}', [SubcateController::class, 'delete'])->name('delete.subcate');
    Route::get('/active-subcate/{subcate}', [SubcateController::class, 'active'])->name('active.subcate');
    Route::get('/deactive-subcate/{subcate}', [SubcateController::class, 'deactive'])->name('deactive.subcate');
    Route::get('/deactive-subcate-list', [SubcateController::class, 'deactiveList'])->name('deactive.subcate.list');


    //WEBSITES ROUTES
    Route::get('/website', [WebsiteController::class, 'index'])->name('admin.website');
    Route::post('/create/website', [WebsiteController::class, 'create'])->name('create.website');
    Route::post('/update/website/{website}', [WebsiteController::class, 'update'])->name('update.website');
    Route::get('/delete/website/{website}', [WebsiteController::class, 'delete'])->name('delete.website');
    Route::get('/active-website/{website}', [WebsiteController::class, 'active'])->name('active.website');
    Route::get('/deactive-website/{website}', [WebsiteController::class, 'deactive'])->name('deactive.website');
    Route::get('/deactive-website-list', [WebsiteController::class, 'deactiveList'])->name('deactive.website.list');

    //product ROUTES
    Route::get('/list-product', [ProductController::class, 'index'])->name('index.product');
    Route::get('/create-product', [ProductController::class, 'create'])->name('create.product');
    Route::post('/store-product', [ProductController::class, 'store'])->name('store.product');
    Route::get('/edit-product/{product}', [ProductController::class, 'edit'])->name('edit.product');
    Route::post('/update-product/{product}', [ProductController::class, 'update'])->name('update.product');
    Route::get('/delete-product/{product}', [ProductController::class, 'delete'])->name('delete.product');
    Route::get('/active-product/{product}', [ProductController::class, 'active'])->name('active.product');
    Route::get('/deactive-product/{product}', [ProductController::class, 'deactive'])->name('deactive.product');
    Route::get('/deactive-product-list', [ProductController::class, 'deactiveList'])->name('deactive.product.list');


    //testimonial ROUTES
    Route::get('/list-testimonial', [TestimonialController::class, 'index'])->name('index.testimonial');
    Route::get('/create-testimonial', [TestimonialController::class, 'create'])->name('create.testimonial');
    Route::post('/store-testimonial', [TestimonialController::class, 'store'])->name('store.testimonial');
    Route::get('/edit-testimonial/{testimonial}', [TestimonialController::class, 'edit'])->name('edit.testimonial');
    Route::post('/update-testimonial/{testimonial}', [TestimonialController::class, 'update'])->name('update.testimonial');
    Route::get('/delete-testimonial/{testimonial}', [TestimonialController::class, 'delete'])->name('delete.testimonial');
    Route::get('/active-testimonial/{testimonial}', [TestimonialController::class, 'active'])->name('active.testimonial');
    Route::get('/deactive-testimonial/{testimonial}', [TestimonialController::class, 'deactive'])->name('deactive.testimonial');
    Route::get('/deactive-testimonial-list', [TestimonialController::class, 'deactiveList'])->name('deactive.testimonial.list');



    //SETTING ROUTE ARE HERE
    Route::get('setting', [SettingController::class,'index'])->name('setting');
    Route::post('setting-store',[SettingController::class,'store'])->name('store.setting');
    Route::post('setting-update',[SettingController::class,'update'])->name('update.setting');

    
    //contact MORE ROUTES
    Route::get('/contact-messages', [AdminController::class, 'contactMessages'])->name('admin.contact.messages');
    Route::get('/delete/contact/{contact}', [AdminController::class, 'delete'])->name('delete.contact');
    Route::get('/active-contact/{contact}', [AdminController::class, 'active'])->name('active.contact');
    Route::get('/deactive-contact/{contact}', [AdminController::class, 'deactive'])->name('deactive.contact');
    Route::get('/deactive-contact-list', [AdminController::class, 'deactiveList'])->name('deactive.contact.list');

});


// logout
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');


