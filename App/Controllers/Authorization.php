<?php
/**
 * Created by PhpStorm.
 * User: ssv
 * Date: 10.05.20
 * Time: 16:17
 */

namespace App\Controllers;


use Core\BaseController;

class Authorization extends BaseController
{

    public function loginPage()
    {
        return $this->view
            ->display('auth/login.html.twig');
    }

    public function login()
    {
        var_dump($_POST);
    }
    /*
        public function register()
        {
            return $this->view->display('auth/register.html.twig');
        }
    */
    public function logout()
    {
        return 'Authorization Controller and method logout';
    }

}