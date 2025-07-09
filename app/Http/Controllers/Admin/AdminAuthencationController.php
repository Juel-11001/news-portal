<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRestPasswordRequest;
use App\Http\Requests\HandleLogin;
use App\Http\Requests\HandleLoginRequest;
use App\Http\Requests\SendResetLinkRequest;
use App\Mail\AdminSendResetLinkMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminAuthencationController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }
    public function loginHandle(HandleLoginRequest $request)
    {
        $request->authenticate();
        return redirect()->route('admin.dashboard');
    }
    public function forgotPassword()
    {
        return view('admin.auth.forgot-password');
    }
    public function forgotPasswordHandle(SendResetLinkRequest $request)
    {
        // dd($request->all());
        $token=\Str::random(60);
        $admin=Admin::where('email',$request->email)->first();
        $admin->remember_token=$token;
        $admin->save();
        Mail::to($request->email)->send(new AdminSendResetLinkMail($token, $request->email));
        return redirect()->back()->with('success', 'Check your email for password reset link');
    }
    public function resetPassword($token)
    {
        // dd($token);
        return view('admin.auth.reset-password',compact('token'));
    }
    public function resetPasswordHandle(AdminRestPasswordRequest $request)
    {
        $admin=Admin::where('email', $request->email, $request->token)->first();
        if(!$admin){
            return redirect()->back()->with('error', 'Invalid token');
        }
        $admin->password=bcrypt($request->password);
        $admin->save();
        return redirect()->route('admin.login')->with('success', 'Password reset successfully');
    }
}
