<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Admin\Schedule;
use App\Models\User\Practical;
use App\Models\User\Payment;
use App\Models\Admin\Centre;
use Stripe;
use Carbon\Carbon;

class PracticalController extends Controller
{ 

    public function practicalTest()
    {
        $centres = Centre::where('status',1)->get();
        return view('user.practical.practical',compact('centres'));
    }

    public function practicalCentre(Request $request)
    {
        $request->session()->put('centre_id',$request->centre_id);
        $centre = Centre::where('id',Session::get('centre_id'))->first();
        return view('user.practical.practical_form',compact('centre'));
    }


    public function practicalForm(Request $request)
    {

        // return $request->all();
        // $centre = Centre::where('id',Session::get('centre_id'))->first();
        // $to = \Carbon\Carbon::createFromFormat('Y-m-d', $request->pre_bookingdate);
        // $from = \Carbon\Carbon::createFromFormat('Y-m-d', $centre->date);
        // $diff_in_days = $to->diffInDays($from);
        // dd($diff_in_days);
        $request->validate([
            'mobile'=> 'max:16',
            'license'=> 'min:8',
            'name'=> 'max:191',
            'email'=> 'max:191',
            'tcertificate_num'=> 'max:191',
            'address'=> 'max:191',
            'theorytest_no'=> 'max:191',
        ]);

        // if($diff_in_days >= 13){

            $request->session()->put('centre_id',$request->centre_id);
            $request->session()->put('name',$request->name);
            $request->session()->put('license',$request->license);
            $request->session()->put('address',$request->address);
            $request->session()->put('postcode',$request->postcode);
            $request->session()->put('email',$request->email);
            $request->session()->put('mobile',$request->mobile);
            $request->session()->put('tcertificate_num',$request->tcertificate_num);
            $request->session()->put('theory_expdate',$request->theory_expdate);
            $request->session()->put('transmission',$request->transmission);
            $request->session()->put('pre_bookingdate',$request->pre_bookingdate);
            // $request->session()->put('photo',$request->photo);
            $request->session()->put('is_theory',$request->is_theory);
            $request->session()->put('theorytest_no',$request->theorytest_no);
            // $request->session()->put('track_id','FDT-'.substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 6));
            $request->session()->put('is_booked',$request->is_booked);
            $request->session()->put('is_revoked',$request->is_revoked);
            // $request->session()->put('need_instructor',$request->need_instructor);
            $request->session()->put('status',$request->status);

            return redirect()->route('practical.test.payment');
        // }else{
        //     return redirect()->back()->with('wrong','wrong');
        // }

    }

    public function payment(Request $request)
    {


        $centre_id = $request->session()->get('centre_id',$request->centre_id);
        $name = $request->session()->get('name',$request->name);
        $license = $request->session()->get('license',$request->license);
        $address = $request->session()->get('address',$request->address);
        $postcode = $request->session()->get('postcode',$request->postcode);
        $email = $request->session()->get('email',$request->email);
        $mobile = $request->session()->get('mobile',$request->mobile);
        $tcertificate_num = $request->session()->get('tcertificate_num',$request->tcertificate_num);
        $theory_expdate = $request->session()->get('theory_expdate',$request->theory_expdate);
        $transmission = $request->session()->get('transmission',$request->transmission);
        $is_theory = $request->session()->get('is_theory',$request->is_theory);
        $pre_bookingdate = $request->session()->get('pre_bookingdate',$request->pre_bookingdate);
        $theorytest_no = $request->session()->get('theorytest_no',$request->theorytest_no);
        $track_id = $request->session()->get('track_id',$request->track_id);
        // $request->session()->get('photo',$request->photo);
        $is_booked = $request->session()->get('is_booked',$request->is_booked);
        $is_revoked = $request->session()->get('is_revoked',$request->is_revoked);
        $need_instructor = $request->session()->get('need_instructor',$request->need_instructor);
        $status = $request->session()->get('status',$request->status);


        $centre = Centre::where('id',$centre_id)->first();


        return view('user.practical.payment',compact('centre','centre_id','name','license','address','postcode','email','mobile','tcertificate_num','theory_expdate','transmission','is_booked','is_revoked','is_theory','pre_bookingdate','theorytest_no','track_id','need_instructor','status'));
    }

    public function paymentDone(Request $request)
    {
        $practical = Practical::create([
            'centre_id'=>$request->centre_id,
            'name'=>$request->name,
            'license'=>$request->license,
            'address'=>$request->address,
            'postcode'=>$request->postcode,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'tcertificate_num'=>$request->tcertificate_num,
            'theory_expdate'=>$request->theory_expdate,
            'transmission'=>$request->transmission,
            'is_theory'=>$request->is_theory,
            'pre_bookingdate'=>$request->pre_bookingdate,
            'theorytest_no'=>$request->theorytest_no,
            'track_id'=>  'FDT-'.substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 6),
            // 'photo'=>$request->photo,
            'is_booked'=>$request->is_booked,
            'is_booked'=>$request->is_booked,
            'need_instructor'=>$request->need_instructor,
            'ref_id'=>$request->ref_id,
            'date'=>$request->date,
            'centre_name'=>$request->centre_name,
            'status'=>$request->status,
        ]);

        $this->storePhoto($practical);


        if($practical){
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $chart_id = $request->session()->put('key', $request->custID);

            // return $request->all();
            $paymentsuccess = Stripe\Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => $request->custID . $request->stripeToken,
            ]);
            // $coun = rand();

            if($paymentsuccess){
                $payment = Payment::create([
                    'practical_id'=>$practical->id,
                    'address'=>$request->address,
                    'address2'=>$request->address2,
                    'city'=>$request->city,
                    'amount'=>$request->amount,
                    'card_name'=>$request->card_name,
                    'card_number'=>$request->card_number,
                    'card_cvc'=>$request->card_cvc,
                    'card_exp_month'=>$request->card_exp_month,
                    'card_exp_year'=>$request->card_exp_year,
                    'pay_method'=>$request->pay_method,
                    'charge_id'=>$paymentsuccess->id,
                ]);
                // $request->session()->flush();

                $details = [
                    'title' => 'Booking Confirmation',
                    'centre_name'=>$practical->centre_name,
                    'centre_date'=>$practical->date,
                    'paid'=>$request->amount,
                    'name'=>$practical->name,
                    'license'=>$practical->license,
                    'address'=>$practical->address,
                    'postcode'=>$practical->postcode,
                    'email'=>$practical->email,
                    'mobile'=>$practical->mobile,
                    'tcertificate_num'=>$practical->tcertificate_num,
                    'theory_expdate'=>$practical->theory_expdate,
                    'transmission'=>$practical->transmission,
                    'is_theory'=>$practical->is_theory,
                    'pre_bookingdate'=>$practical->pre_bookingdate,
                    'theorytest_no'=>$practical->theorytest_no,
                    'track_id'=>  $practical->track_id,
                    // 'photo'=>$request->photo,
                    'is_booked'=>$practical->is_booked,
                    'is_revoked'=>$practical->is_revoked,
                    'need_instructor'=>$practical->need_instructor,
                    'status'=>$practical->status,
                ];
                $adminmails = [
                    'title' => 'New Test Booking',
                    'centre_name'=>$practical->centre_name,
                    'centre_date'=>$practical->date,
                    'paid'=>$request->amount,
                    'name'=>$practical->name,
                    'license'=>$practical->license,
                    'address'=>$practical->address,
                    'postcode'=>$practical->postcode,
                    'email'=>$practical->email,
                    'mobile'=>$practical->mobile,
                    'tcertificate_num'=>$practical->tcertificate_num,
                    'theory_expdate'=>$practical->theory_expdate,
                    'transmission'=>$practical->transmission,
                    'is_theory'=>$practical->is_theory,
                    'pre_bookingdate'=>$practical->pre_bookingdate,
                    'theorytest_no'=>$practical->theorytest_no,
                    'track_id'=>  $practical->track_id,
                    // 'photo'=>$request->photo,
                    'is_booked'=>$practical->is_booked,
                    'is_revoked'=>$practical->is_revoked,
                    'need_instructor'=>$practical->need_instructor,
                    'status'=>$practical->status,
                ];


                \Mail::to($request->email)->send(new \App\Mail\MyMail($details));
                \Mail::to(env('MAIL_USERNAME'))->send(new \App\Mail\AdminMail($adminmails));
                 if($payment){
                    $centre = centre::where('id',$request->session()->get('centre_id'))->first();
                    $centre->delete();
                }
                $request->session()->flush();
                Session::flash('success', 'Payment successful ! Check your mail');
                return back();
            }
        }else{
            return back()->with('wrong','your some information mission');
        }

    }

    private function storePhoto($practical)
    {
        if(request()->hasFile('photo')){
            $practical->update([
                'photo' => request()->photo->store('admin/practical','public'),
            ]);

            // $resize = photo::make('storage/app/public/'.$practical->photo)->resize(600, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            // $resize->save();
        }
    }

}
