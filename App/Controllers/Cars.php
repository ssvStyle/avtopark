<?php

namespace App\Controllers;

use App\Servise\Avtopark;
use Core\BaseController;

class Cars extends BaseController
{

    public function showAll()
    {
        $this->view->addGlobal('cars', Avtopark::get('avto'));

        return $this->view->display('cars.html.twig');
    }

}