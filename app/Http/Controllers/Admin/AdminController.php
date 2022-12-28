<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Contact;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function contactMessages()
    {
        $contacts = Contact::latest()->get();
        $count= 1;
        return view('admin.contact.contact_messages',compact('contacts','count'));
    }

    public function active(contact $contact)
    {
        $contact->update(['status' => 1]);
        if($contact){
            return redirect()->back()->with('success','This contact activate successfully.');
        }else{
            return redirect()->back()->with('wrong','Something went wrong.');
        }
    }

    
    public function deactive(contact $contact)
    {
        $contact->update(['status' => 0]);
        if($contact){
            return redirect()->back()->with('success','This contact deactive successfully.');
        }else{
            return redirect()->back()->with('wrong','Something went wrong.');
        }
    }

    public function delete(contact $contact)
    {
        // if($contact->image){
        // unlink('storage/app/public/'.$contact->image);
        // }
        $contact->delete();
          return redirect()->back()->with('deletesuccess','Deleted Successful');
    }
}
