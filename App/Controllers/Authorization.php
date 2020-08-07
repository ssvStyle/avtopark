<?php

namespace App\Controllers;


use App\Servise\Validation;
use Core\BaseController;
use App\Servise\AuthServise;

class Authorization extends BaseController
{

    public function loginPage()
    {
        return $this->view
            ->display('auth/login.html.twig');
    }

    public function login()
    {
        if (Validation::checkFormAuth($_POST)) {

            AuthServise::setAuth(Validation::checkFormAuth($_POST));

        } else {

            $this->view->addGlobal('error', 'Неверный логин или пароль');
            $this->loginPage();

        }

    }

    public function logout()
    {
        return 'AuthServise Controller and method logout';
    }

}