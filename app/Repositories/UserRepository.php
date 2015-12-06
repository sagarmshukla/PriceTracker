<?php
/**
 * Created by PhpStorm.
 * User: ampersandthree
 * Date: 14/08/15
 * Time: 5:32 PM
 */

namespace Trackyourprice\Repositories;
use Trackyourprice\User;

class UserRepository {

    public function findByUserNameOrCreate($userData) {


        $user = User::where('provider_id', '=', $userData->id)->orWhere('email', $userData->email)->first();

        if(!$user) {

            $user = new User();
            $user->provider_id = $userData->id;
            $user->name = $userData->name;
            $user->email = $userData->email;
            $user->avatar = $userData->avatar;
            $user->save();

        }

        $this->checkIfUserNeedsUpdating($userData, $user);
        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user) {

        $socialData = [
            'avatar' => $userData->avatar,
            'email' => $userData->email,
            'name' => $userData->name,
        ];
        $dbData = [
            'avatar' => $user->avatar,
            'email' => $user->email,
            'name' => $user->name,
        ];

        if (!empty(array_diff($socialData, $dbData))) {
            $user->avatar = $userData->avatar;
            $user->email = $userData->email;
            $user->name = $userData->name;
            $user->save();
        }
    }


}