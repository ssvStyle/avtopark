<?php

namespace App\Servise;

use App\Models\Authorization as AuthModel;
use App\Models\Db;


class AuthServise
{

    public static function setAuth(array $userData = [])
    {

        $auth = new AuthModel(new Db());
        if ($auth->loginExist($userData['login']) && $auth->loginAndPassValidation($userData['login'], $userData['pass'])) {
            $auth->setAuth();
        }

    }

}