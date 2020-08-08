<?php

namespace App\Controllers;

use Core\BaseController;
use App\Servise\AuthServise;

class Authorization extends BaseController
{

    public function loginPage()
    {
        return $this->view->display('auth/login.html.twig');
    }

    public function login()
    {
        $error = AuthServise::setAuth();

        if ($error !== true) {

            $this->view->addGlobal('errors', $error);
            $this->loginPage();

        } else {

            header('Location: home');

        }

    }

    public function logout()
    {
        AuthServise::logout();
        header('Location: home');
    }

}