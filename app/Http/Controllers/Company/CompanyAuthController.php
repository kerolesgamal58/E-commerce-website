<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyAuthController extends Controller
{
    public function getLoginPage(){
        return view('company.login');
    }

    public function doLogin(Request $request){
        $request->validate(['email' => 'email']);

        $credentials = $request->only(['email', 'password']);
        $remember_me = $request->remember_me == 1 ? true : false;

        if ( !Auth::guard('web')->attempt($credentials, $remember_me) ){
            return redirect()->back()->with(['error' => __('admin.incorrect_email_or_password')]);
        }

        $request->session()->regenerate();
        return redirect()->intended('company/');
    }

    public function logout(Request $request){
        Auth::guard('web');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('company.login');
    }

    public function getSignInPage(){
        return view('company.signin');
    }

    public function doSignIn(CompanyRequest $request){
//        return $request;
        $user = User::create($request->except('_token'));

        $credentials = $request->only(['email', 'password']);
        $remember_me = $request->remember_me == 1 ? true : false;
        Auth::guard('web')->attempt($credentials, $remember_me);
        $request->session()->regenerate();
        return redirect()->route('verification.send');
    }

    public function getForgotPasswordPage(){

    }

    public function doForgotPassword(){

    }

    public function verify_email(EmailVerificationRequest $request){
        $request->fulfill();

        return redirect()->route('company.login')->with(['success' => __('admin.verification_message_success')]);
    }

    public function verification_message(){
        return view('company.sentVerificationMessage');
    }

    public function verification_message_resend(Request $request){
        $request->user()->sendEmailVerificationNotification();

        return redirect()->route('verification.notice');
    }
}
