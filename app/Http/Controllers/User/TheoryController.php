<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Admin\Schedule;
use App\Models\User\theory;
use App\Models\User\Payment;
use App\Models\Admin\Theorycentre;
use Stripe;
use Carbon\Carbon;

class TheoryController extends Controller
{
    public function theoryTest()
    {
        $theorycentres = Theorycentre::where('status',1)->get();
        return view('user.theory.theory',compact('theorycentres'));
    }

    public function theoryCentre(Request $request)
    {
        $request->session()->put('theorycentre_id',$request->theorycentre_id);
        $theorycentre = theorycentre::where('id',Session::get('theorycentre_id'))->first();
        return view('user.theory.theory_form',compact('theorycentre'));
    }


    public function theoryForm(Request $request)
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
            'postcode'=> 'max:191',
            'address'=> 'max:191',
        ]);

        // if($diff_in_days >= 13){

            $request->session()->put('theorycentre_id',$request->theorycentre_id);
            $request->session()->put('theoryname',$request->name);
            $request->session()->put('theorylicense',$request->license);
            $request->session()->put('theoryaddress',$request->address);
            $request->session()->put('theorypostcode',$request->postcode);
            $request->session()->put('theoryemail',$request->email);
            $request->session()->put('theorymobile',$request->mobile);
            // $request->session()->put('photo',$request->photo);
            $request->session()->put('theorystatus',$request->status);

            return redirect()->route('theory.test.payment');
        // }else{
        //     return redirect()->back()->with('wrong','wrong');
        // }

    }

    public function theoryPayment(Request $request)
    {

        $theorycentre_id = $request->session()->get('theorycentre_id');
        $theoryname = $request->session()->get('theoryname');
        $theorylicense = $request->session()->get('theorylicense');
        $theoryaddress = $request->session()->get('theoryaddress');
        $theorypostcode = $request->session()->get('theorypostcode');
        $theoryemail = $request->session()->get('theoryemail');
        $theorymobile = $request->session()->get('theorymobile');
        // $request->session()->get('photo',$request->photo);
        $theorystatus = $request->session()->get('theorystatus');

        $theorycentre = Theorycentre::where('id',$theorycentre_id)->first();


        return view('user.theory.payment',compact('theorycentre','theorycentre_id','theoryname','theorylicense','theoryaddress','theorypostcode','theoryemail','theorymobile','theorystatus'));
    }

    public function paymentDone(Request $request)
    {
        $theory = theory::create([
            'theorycentre_id'=>$request->theorycentre_id,
            'name'=>$request->name,
            'license'=>$request->license,
            'address'=>$request->address,
            'postcode'=>$request->postcode,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'track_id'=>  'FDT-'.substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 6),
            'ref_id'=>$request->ref_id,
            'date'=>$request->date,
            'centre_name'=>$request->centre_name,
            // 'photo'=>$request->photo,
            'status'=>$request->status,
        ]);

        $this->storePhoto($theory);


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
                'theory_id'=>$theory->id,
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
                // 'charge_id'=>$coun,
            ]);
            // $request->session()->flush();

            $theorymail = [
                'title' => 'Theory Test Booking Confirmation',
                'centre_name'=>$theory->centre_name,
                'centre_date'=>$theory->date,
                'paid'=>$request->amount,
                'name'=>$theory->name,
                'license'=>$theory->license,
                'address'=>$theory->address,
                'postcode'=>$theory->postcode,
                'email'=>$theory->email,
                'mobile'=>$theory->mobile,
                'track_id'=>  $theory->track_id,
                // 'photo'=>$request->photo,
                'status'=>$theory->status,
            ];
            $adminmails = [
                'title' => 'New Theory Test Booking',
                'centre_name'=>$theory->centre_name,
                'centre_date'=>$theory->date,
                'paid'=>$request->amount,
                'name'=>$theory->name,
                'license'=>$theory->license,
                'address'=>$theory->address,
                'postcode'=>$theory->postcode,
                'email'=>$theory->email,
                'mobile'=>$theory->mobile,
                'track_id'=>  $theory->track_id,
                'ref_id'=>  $theory->ref_id,
                // 'photo'=>$request->photo,
                'status'=>$theory->status,
            ];

            \Mail::to($request->email)->send(new \App\Mail\TheoryMail($theorymail));
            \Mail::to(env('MAIL_USERNAME'))->send(new \App\Mail\AdminTheoryMail($adminmails));
            if($payment){
                $theorycentre = Theorycentre::where('id',$request->session()->get('theorycentre_id'))->first();
                $theorycentre->delete();
            }
            $request->session()->flush();
            Session::flash('success', 'Payment successful ! Check your mail');
            return back();
        }


    }

    private function storePhoto($theory)
    {
        if(request()->hasFile('photo')){
            $theory->update([
                'photo' => request()->photo->store('admin/theory','public'),
            ]);

            // $resize = photo::make('storage/app/public/'.$theory->photo)->resize(600, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            // $resize->save();
        }
    }
}
