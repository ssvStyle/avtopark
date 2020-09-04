<?php

namespace App\Service;

use App\Models\Authorization as AuthModel;
use App\Models\Db;


class AuthService
{

    public static function setAuth($post)
    {
        $userData = Validation::checkFormAuth($post);
        $auth = new AuthModel(new Db());

        if (empty($userData['errors'])) {
            if ($auth->loginAndPassValidation($userData['login'], $userData['pass'])) {
                if (isset($userData['remember']) && $userData['remember'] == 'on') {
                    $auth->setAuth(true);
                } else {
                    $auth->setAuth();
                }
                return true;
            }
        }
        return $userData['errors'];
    }

    public static function logout()
    {
        $auth = new AuthModel(new Db());
        $auth->exitAuth();
    }

}