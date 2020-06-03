<?php

namespace App\Controllers;

use App\Servise\Avtopark;
use App\Servise\Validation;
use Core\BaseController;

class Park extends BaseController
{

    public function showAll()
    {
        $this->view->addGlobal('avtopark', Avtopark::get('park'));

        return $this->view->display('park.html.twig');
    }

    public function create()
    {
        var_dump($_POST);

        $err = [];

        if ( isset($_POST['save']) ) {

            $err = Validation::avtopark($_POST);

            if (empty($err)) {



            }

        }

        $this->view->addGlobal('title', 'Добавить новый');

        $this->view->addGlobal('errors', $err);

        $this->view->addGlobal('avtoparkName', $_POST['avtoparkName'] ?? '');

        $this->view->addGlobal('avtoparkAdres', $_POST['avtoparkAdres'] ?? '');

        $this->view->addGlobal('avtoparkSchedule', $_POST['avtoparkSchedule'] ?? '');

        return $this->view->display('editPark.html.twig');

    }

    public function edit()
    {
        $avtopark = Avtopark::getById( (int)$this->data['id'], 'park' );

        $err = [];

        if ( isset($_POST['save']) ) {

            $err = Validation::avtopark($_POST);

            if (empty($err)) {

                #TODO save

            }

        }

        $this->view->addGlobal('title', 'Редактировать');

        $this->view->addGlobal('errors', $err);

        $this->view->addGlobal('avtoparkName', $avtopark->name);

        $this->view->addGlobal('avtoparkAdres', $avtopark->adres);

        $this->view->addGlobal('avtoparkSchedule', $avtopark->schedule);

        $this->view->addGlobal('cars', $avtopark->getCars());

        return $this->view->display('editPark.html.twig');
    }

}