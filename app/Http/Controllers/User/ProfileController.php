<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{

    public function profile(User $user)
    {
        $count = 1;
        return view('user.profile.profile',compact('user'));
    }

    public function update(User $user,Request $request){
        $request->validate([
            'first_name'=>'max:191',
            'last_name'=>'max:191',
        ]);
        // if(!Auth::user()->google_id){
        //     $user->update([
        //         'name'=>$request->name,
        //         'email'=>$request->email,
        //     ]);
        // }else{
            $user->update([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
            ]);
        // }

        if($user){
            return redirect()->back()->with('success', 'Profile details updated successfully');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }

    }

    //CHANGE PASSWORD

    public function editPassword()
    {
        return view('auth.passwords.change');
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        dd('Password change successfully.');
    }



}
