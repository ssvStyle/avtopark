<?php

namespace App\Controllers;

use Core\BaseController;
use App\Service\AuthService;

class Authorization extends BaseController
{

    public function loginPage()
    {
        return $this->view->display('auth/login.html.twig');
    }

    public function login()
    {
        $error = AuthService::setAuth($_POST);

        if ($error !== true) {

            $this->view->addGlobal('errors', $error);
            $this->loginPage();

        } else {

            header('Location: home');

        }

    }

    public function logout()
    {
        AuthService::logout();
        header('Location: home');
    }

}