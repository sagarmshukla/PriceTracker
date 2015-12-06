<?php
/**
 * Created by PhpStorm.
 * User: ampersandthree
 * Date: 14/08/15
 * Time: 12:48 PM
 */

namespace Trackyourprice\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Socialite;
use Trackyourprice\Product\AuthenticateUser;
use Illuminate\Routing\Controller;
use Trackyourprice\Http\Controllers\Route;
use Illuminate\Http\Request;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the google authentication page.
     *
     * @param Request $request
     * @return Response
     */

    public function loginView(){
        return view('login.Index');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
//        $googleInfo = Socialite::driver('google')->user();
        $facebookInfo = Socialite::driver('facebook')->user();
        return $facebookInfo->getEmail(); //Returns the email id of an user

        // $user->token;
    }


    public function login(AuthenticateUser $authenticateUser, Request $request, $provider = '') {
       return $authenticateUser->execute($request->all(), $this, $provider);
    }

    public function userHasLoggedIn($user) {
        \Session::flash('message', 'Welcome, ' . $user->username);
        return Redirect::route('dashboard');
    }
}