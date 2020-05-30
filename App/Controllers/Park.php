<?php

namespace App\Controllers;

use \App\Servise\Validation;
use Core\BaseController;

class Park extends BaseController
{

    public function showAll()
    {
        return $this->view->display('park.html.twig');
    }

    public function create()
    {

        $err = [];

        if ( isset($_POST['save']) ) {

            $err = Validation::avtopark($_POST);

            if (empty($err)) {

                #TODO save

            }

        }

        $this->view->addGlobal('errors', $err);

        $this->view->addGlobal('avtoparkName', $_POST['avtoparkName'] ?? '');

        $this->view->addGlobal('avtoparkAdres', $_POST['avtoparkAdres'] ?? '');

        $this->view->addGlobal('avtoparkSchedule', $_POST['avtoparkSchedule'] ?? '');

        return $this->view->display('createPark.html.twig');
    }

}