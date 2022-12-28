<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use Image;
use Str;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $setting = Setting::first();
        return view('admin.setting',compact('setting'));
    }

    public function store()
    {
        $setting = Setting::create($this->validateData());
        $this->storeImage($setting);
        if ($setting) {
            return redirect()->back()->with('success','Setting Updated Successfully!!');
        }else{
            return redirect()->back()->with('wrong','Something Went Wrong!!');
        }
    }

    public function update()
    {
        
        $setting = Setting::first();
        $setting->update($this->validateData());


        if (request()->has('favicon')) {
            if (request()->oldfavicon) {
                unlink('storage/app/public/'.request()->oldfavicon);
            }
            $this->storeImage($setting);
        }

        if (request()->has('logo')) {
            if (request()->oldlogo) {
                unlink('storage/app/public/'.request()->oldlogo);
            }
            $this->storeImage($setting);
        }

        if (request()->has('cover_image')) {
            if (request()->oldcover) {
                unlink('storage/app/public/'.request()->oldcover);
            }
            $this->storeImage($setting);
        }

        if ($setting) {
            return redirect()->back()->with('success','Setting Updated Successfully!!');
        }else{
            return redirect()->back()->with('wrong','Something went wrong!!');
        }

    }

    public function messages()
    {
        $contacts = Contact::latest()->get();
        $count = 1;
        return view('admin.contact.contactlist',compact('contacts','count'));
    }

    private function validateData()
    {
        return request()->validate([
            'title' => 'required',
            'meta_description' => 'max:160',
            'about' => 'max:600',
            'meta_keywords' => '',
            'email' => '',
            'phone' => '',
            'hotline' => '',
            'address' => '',
            'web_link' => '',
            'fb_link' => '',
            'twitter_link' => '',
            'instagram_link' => '',
            'youtube_link' => '',
            'service_years' => '',
            'notice' => '',
            'logo' => '',
            'favicon' => '',
            'cover_image' => ''
        ]);
    }

    private function storeImage($setting)
    {
        if (request()->has('favicon')) {
            $setting->update([
                'favicon' => request()->favicon->store('admin/setting','public'),
            ]);
            $resize = Image::make('storage/app/public/'.$setting->favicon)->resize(60,60);
            $resize->save();
        }
        if (request()->has('logo')) {
            $setting->update([
                'logo' => request()->logo->store('admin/setting','public'),
            ]);
            $resize = Image::make('storage/app/public/'.$setting->logo)->resize(326,80);
            $resize->save();
        }
        if (request()->has('cover_image')) {
            $setting->update([
                'cover_image' => request()->cover_image->store('admin/setting','public'),
            ]);
            $resize = Image::make('storage/app/public/'.$setting->cover_image)->resize(500,500);
            $resize->save();
        }
    }
}
