<?php

namespace App\Controllers;

use Core\BaseController;

class Cars extends BaseController
{

    public function showAll()
    {
        return $this->view->display('cars.html.twig');
    }

}