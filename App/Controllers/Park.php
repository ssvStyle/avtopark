<?php

namespace App\Controllers;

use App\Servise\Avtopark;
use App\Servise\Validation;
use Core\BaseController;

class Park extends BaseController
{

    public function showAll()
    {
        $this->view->addGlobal('result', $_SESSION['result'] ?? '');

        unset($_SESSION['result']);

        $this->view->addGlobal('avtopark', Avtopark::get('park'));

        return $this->view->display('park.html.twig');
    }

    public function create()
    {

        $this->view->addGlobal('title', 'Добавить новый');

        $this->view->addGlobal('errors', $_SESSION['newApErr'] ?? '');

        unset($_SESSION['newApErr']);

        $this->view->addGlobal('avtoparkName', $_POST['avtoparkName'] ?? '');

        $this->view->addGlobal('avtoparkAdres', $_POST['avtoparkAdres'] ?? '');

        $this->view->addGlobal('avtoparkSchedule', $_POST['avtoparkSchedule'] ?? '');

        return $this->view->display('editPark.html.twig');

    }

    public function edit()
    {
        $this->view->addGlobal('title', 'Редактировать');

        $avtopark = Avtopark::getById( (int)$this->data['id'], 'park' );

        if ($avtopark === null) {

            $this->view->addGlobal('errors', ['notExist' => 'Такого парка не существует!']);

        } else {

            $this->view->addGlobal('errors', $_SESSION['newApErr'] ?? '');

            $this->view->addGlobal('avtoparkId', $avtopark->id);

            $this->view->addGlobal('avtoparkName', $avtopark->name);

            $this->view->addGlobal('avtoparkAdres', $avtopark->adres);

            $this->view->addGlobal('avtoparkSchedule', $avtopark->schedule);

            $this->view->addGlobal('cars', $avtopark->getCars());

        }

        return $this->view->display('editPark.html.twig');

    }

    public function save()
    {

        if (!empty($_POST['avtoparkId'])) {

            $err = Validation::avtopark($_POST);

            if ( empty($err) ) {

                Avtopark::updatePark($_POST);

                $_SESSION['result'] = 'Парк обновлён';

            } else {

                $_SESSION['newApErr'] = $err;

                header('Location: ../avtopark/edit/' . $_POST['avtoparkId']);

            }

        } else {

                if ( isset($_POST['save']) ) {

                    $err = Validation::avtopark($_POST);

                    if ( empty($err) ) {

                        Avtopark::savePark($_POST);

                        $_SESSION['result'] = 'Новый парк добавлен';

                    } else {

                        $_SESSION['newApErr'] = $err;

                        header('Location: ../avtopark/create');

                    }

                }

        }

        header('Location: ../catalog/park/all');

    }

    public function delPark()
    {

        Avtopark::delete((int)$this->data['id']);

        $_SESSION['result'] = 'Парк Удалён';

        header('Location: ../../catalog/park/all');

    }



}