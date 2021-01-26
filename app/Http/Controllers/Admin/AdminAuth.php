<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminResetPassword;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminAuth extends Controller
{
    public function index(){
        return view('admin.home');
    }

    public function login(){
        return view('admin.login');
    }

    public function dologin(Request $request){
            $rememberme = $request->rememberme == 1 ? true : false;
            if (Auth::guard('admin')->attempt([
                'email' => $request->email,
                'password' => $request->password],
                $rememberme
            )){
                $request->session()->regenerate();
                return redirect()->intended('/admin');
            }
            else{
                session()->flash('error', __('admin.incorrect_information_login'));
                return redirect()->back()->with([
                    'error' => 'The provided credentials do not match our records.'
                ]);
            }
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function forgot_password(){
        return view('admin.forgot_password');
    }

    public function forgot_password_post(Request $request){
        //validate email
        $request->validate( ['email' => 'required|email'] );
        //check if email is correct
        $admin = Admin::where('email', $request->email)->first();
        if (is_null($admin))
            return back()->with(['error' => __('passwords.user')]);

        //create token
        $token = Str::random(64);
        //insert token to 'admin_password_resets' database table
        DB::table('admin_password_resets')->insert([
            'email' => $admin->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        //try send email
        try {
            Mail::to($admin->email)->send(new AdminResetPassword(['admin' => $admin, 'token' => $token]));
            return back()->with(['success' => __('passwords.sent')]);
        }
        catch (\Exception $exception){
            return back()->with(['error' => __('passwords.throttled')]);
        }
    }

    public function reset_password($token){
        $data = DB::table('admin_password_resets')
            ->where('token', $token)
            ->where('created_at', '>', Carbon::now()->subHours(2))
            ->first();
        if (!empty($data))
            return view('admin.reset_password', ['data' => $data]);
        return redirect()->route('admin.forgot_password')
            ->with(['error' => 'this token is incorrect or has been expired']);
    }

    public function reset_password_post(Request $request, $token){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $data = DB::table('admin_password_resets')
            ->where('token', $token)
            ->where('created_at', '>', Carbon::now()->subHours(2))
            ->first();
        if (!empty($data)){
            Admin::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);
            DB::table('admin_password_resets')
                ->where('token', $token)
                ->delete();
            return redirect()->route('admin.login');
        }
        return redirect()->route('admin.reset_password', $token)
            ->with(['error' => 'this token is incorrect or has been expired']);
    }

}
