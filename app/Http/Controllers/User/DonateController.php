<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Donate;

class DonateController extends Controller
{ 

    public function store(Request $request)
    {

        
        $data = request()->validate([
            'amount'=>'required|max:191',
            'bank_name'=> 'required|max:191',
            'transection_id'=>'required|max:191',
            'name'=>'required|max:191',
            'email'=>'required|max:191',
            'phone'=>'required|max:191',
            'address'=>'',
            
        ]);
        $donate = Donate::create($data);
        if($donate){
            return redirect()->back()->with('success', 'donate Created Successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }

    }

    //PUBLIC FUNCTIONS
    private function validateRequest()
    {
        
        return request()->validate([
            'amount'=>'required|max:191',
            'bank_name'=> 'required|max:191',
            'transection_id'=>'required|max:191',
            'name'=>'required|max:191',
            'email'=>'required|max:191',
            'phone'=>'required|max:191',
            'address'=>'',
            
        ]);
    }
}
