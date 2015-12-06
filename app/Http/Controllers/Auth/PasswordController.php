<?php

namespace Trackyourprice\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Trackyourprice\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Trackyourprice\User;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getEmail()
    {
        return view('auth.password');
    }

    public function postEmail(Request $request)
    {

        $user = $request->all();
        $tokenstore = User::where('email', $request->get('email'))->first();
        $tokenstore->remember_token = $user['_token'];
        $tokenstore->save();
        $token = array('token' => $user['_token']);
        Mail::send('mail.password', $token, function ($m) use ($user) {
            $m->to($user['email'])->subject('Reset Password!');
        });
        Session::flash('email-success', 'Please Check Your Mail to Reset Password.');

        return Redirect::route('login');
    }

    public function getReset($token)
    {
        return view('auth.reset', compact('token'));
    }

    public function postReset(Request $request)
    {
//        dd($request->get('password'));
        $rules = array(

            'password' => 'required',
            'confirmpassword' => 'required|same:password',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $message = $validator->messages();
            return Redirect::route('forgotPassword')->withErrors($message);
        }
        else
        {
            $user = User::where('remember_token', $request->get('_token'))->first();
            $user->password = Hash::make($request->get('password'));
            $user->save();

            Session::flash('password-change', 'Your Password is Changed..!!');
            return view('login.login');
        }


    }
}
