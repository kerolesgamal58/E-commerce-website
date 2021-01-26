<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Mail\CustomerEmailVerification;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use MongoDB\Driver\Session;

class CustomerAuth extends Controller
{
    public function getLoginPage(){
        return view('frontend.login');
    }

    public function doLogin(Request $request){
        $request->validate(['email' => 'email']);

        $credentials = $request->only(['email', 'password']);
        $remember_me = $request->remember_me == 1 ? true : false;

        $check = Auth::guard('customer')->attempt($credentials, $remember_me);
        if (!$check){
            return redirect()->back()->with(['error' => __('admin.incorrect_email_or_password')]);
        }
        $customer = Customer::where('email', $request->email)->get();
        if ( is_null($customer[0]->email_verified_at) ){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('customer.verification_message');
        }

        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('homepage');
    }

    public function getSignInPage(){
        return view('frontend.signin');
    }

    public function doSignIn(CustomerRequest $request){
        $data = $request->except(['_token', 'password']);
        $token = Str::random(64);
        $data = array_merge($data, [
            'email_verification_token' => $token,
            'password' => Hash::make($request->password),
        ]);
//        return $data;
        $customer = Customer::create($data);
        if (!$customer)
            return redirect()->route('customer.signin')->with(['error' => __('admin.creating_customer_error')]);

        Mail::to($request->email)->send(new CustomerEmailVerification([
            'name' => $data['name'],
            'email' => $data['email'],
            'token' => $token,
        ]));
        return redirect()->route('customer.verification_message');
    }

    public function verification_message(){
        return view('frontend.sentVerificationMessage');
    }

    public function verify_email($token, $email){
        $customer = Customer::where('email', $email)->where('email_verification_token', $token)->get();
        if (!$customer){
            return view('frontend.verificationError');
        }

        Customer::where('email', $email)->where('email_verification_token', $token)->update([
            'email_verified_at' => Carbon::now(),
        ]);
        return redirect()->route('customer.login');
    }

}
