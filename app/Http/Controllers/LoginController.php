<?php

namespace Trackyourprice\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Trackyourprice\Http\Requests;
use Trackyourprice\Http\Controllers\Controller;
use Trackyourprice\User;
use Trackyourprice\UserProfile;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('login.login');
    }

    public function getRegister()
    {
        return view('login.register');
    }

    public function getHome()
    {
        return view('layout.index');
    }

    public function postRegister(Request $request)
    {
        $rules =
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:5',
                'signup_confirm' => 'required'
            ];

        $request->old('name');
        $request->old('email');

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            $message = $validator->messages();
            return Redirect::route('register')
                ->withInput()
                ->withErrors($message);
        }

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        $currentUser = User::orderBy('id', 'Desc')->first();
        $userId = new UserProfile();
        $userId->user_id = $currentUser['id'];
        $userId->save();

        Session::flash('register-successful', 'User has been successfully registered');

        return Redirect::route('register');
    }

    public function postLogin(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $rules = array(

            'email' => 'required|email',
            'password' => 'required',

        );

        $request->old('email');

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            $message = $validator->messages();
            return Redirect::route('login')->withInput()->withErrors($message);
        }

        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return Redirect::route('dashboard');
        }

        else
        {
            Session::flash('login-fail', 'Please check your email or password');
            return Redirect::route('login');
        }
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::route('login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
