<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\User\Booking;
use App\Models\User\Bookingdetail;

class BookingController extends Controller
{

    public function booking(Request $request)
    {

        $request->session()->put('course_id',$request->course_id);
        $request->session()->put('package_id',$request->package_id);
        $request->session()->put('car_id',$request->car_id);
        $request->session()->put('amount',$request->amount);
        $request->session()->put('assistant',$request->assistant);
        $request->session()->put('start_date',$request->start_date);
        $request->session()->put('time_slot',$request->time_slot);
        $request->session()->put('quantity',$request->quantity);
        return redirect()->route('booking.create');

    }

    public function bookingCreate(Request $request)
    {

        $course_id = $request->session()->get('course_id');
        $package_id = $request->session()->get('package_id');
        $car_id = $request->session()->get('car_id');
        $amount = $request->session()->get('amount');
        $assistant = $request->session()->get('assistant');
        $start_date = $request->session()->get('start_date');
        $time_slot = $request->session()->get('time_slot');
        $quantity = $request->session()->get('quantity');

        return view('user.checkout.checkout',compact('course_id','package_id','car_id','amount','assistant','start_date','time_slot','quantity',));

    }
    public function bookingStore(Request $request)
    {

        // return $request->all();
        $request->validate([

            'first_name' => 'max:191',
            'last_name' => 'max:191',
            'company' => 'max:191',
            'country' => 'max:191',
            'address' => 'max:191',
            'address2' => 'max:191',
            'city' => 'max:191',
            'state' => 'max:191',
            'zip_code' => 'max:191',
            'phone' => 'max:191',
            'email' => 'max:191',
            'pay_by' => 'max:191',
            'amount'=>'max:191',
            'additional'=>'max:191',

        ]);

        // $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $request->slug);

        $booking = Booking::create([

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company' => $request->company,
            'country' => $request->country,
            'address' => $request->address,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'phone' => $request->phone,
            'email' => $request->email,
            'pay_by' => $request->pay_by,
            'total_amount'=>$request->total_amount,
            'additional'=>$request->additional,

        ]);

        if($booking){
            $bookingdetail = Bookingdetail::create([

                'booking_id' => $booking->id,
                'user_id' => $request->user_id,
                'course_id' => $request->course_id,
                'package_id' => $request->package_id,
                'car_id' => $request->car_id,
                'amount' => $request->amount,
                'assistant' => $request->assistant,
                'start_date' => $request->start_date,
                'time_slot' => $request->time_slot,
                'quantity' => $request->quantity,
                'track_code' => 'ld-'.uniqid(),

            ]);
            return redirect()->back()->with('success', 'You are successfully apply for this course. Please check your email confirmation!!');
        }else{
            return redirect()->back()->with('wrong', 'Something went wrong!!');
        }
    }
}
