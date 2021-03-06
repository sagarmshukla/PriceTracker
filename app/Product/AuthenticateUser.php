<?php
/**
 * Created by PhpStorm.
 * User: ampersandthree
 * Date: 14/08/15
 * Time: 5:21 PM
 */

namespace Trackyourprice\Product;
use Illuminate\Contracts\Auth\Guard;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Trackyourprice\Repositories\UserRepository;
use Trackyourprice\User as users;use Request;
class AuthenticateUser {

    private $socialite;
    private $auth;
    private $users;

    public function __construct(Socialite $socialite, Guard $auth, UserRepository $users) {
        $this->socialite = $socialite;
        $this->users = $users;
        $this->auth = $auth;
    }

    public function execute($request, $listener, $provider) {


        if (!$request) return $this->getAuthorizationFirst($provider);
        $user = $this->users->findByUserNameOrCreate($this->getSocialUser($provider));

        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    private function getAuthorizationFirst($provider) {
        return $this->socialite->driver($provider)->redirect();
    }

    private function getSocialUser($provider) {
        return $this->socialite->driver($provider)->user();
    }



}