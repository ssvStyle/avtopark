<?php

namespace App\Controllers;

use App\Models\Db;
use App\Service\Avtopark;
use App\Service\Validation;
use Core\BaseController;

class Park extends BaseController
{
    protected $authStatus;

    public function __construct()
    {
        parent::__construct();
        $this->authStatus = $auth = new \App\Models\Authorization(new Db());
    }

    public function showAll()
    {

        echo $this->view->display('park.html.twig', [
            'avtopark' => Avtopark::get('park'),
            'result' => $_SESSION['result'] ?? '',
        ]);

        unset($_SESSION['result']);
    }

    public function create()
    {

        $this->access($this->authStatus->userStatusVerify('admin'));

        echo $this->view->display('editPark.html.twig', [
            'title' => 'Добавить новый',
            'errors' => $_SESSION['newApErr'] ?? '',
            'avtoparkName' => $_POST['avtoparkName'] ?? '',
            'avtoparkAdres' => $_POST['avtoparkAdres'] ?? '',
            'avtoparkSchedule' => $_POST['avtoparkSchedule'] ?? '',
        ]);

        unset($_SESSION['newApErr']);

    }

    public function edit()
    {

        $this->access($this->authStatus->userStatusVerify('admin'));

        $this->view->addGlobal('title', 'Редактировать');

        $avtopark = Avtopark::getById( (int)$this->data['id'], 'park' );

        if ($avtopark === null) {

            echo $this->view->display('editPark.html.twig', [
                'errors' => ['notExist' => 'Такого парка не существует!'],
                ]);

        } else {

            echo $this->view->display('editPark.html.twig', [
                'errors' => $_SESSION['newApErr'] ?? '',
                'avtoparkId' => $avtopark->id,
                'avtoparkName' => $avtopark->name,
                'avtoparkAdres' => $avtopark->adres,
                'avtoparkSchedule' => $avtopark->schedule,
                'cars' => $avtopark->getCars()
            ]);

        }



    }

    public function save()
    {
        $this->access($this->authStatus->userStatusVerify('admin'));

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
        $this->access($this->authStatus->userStatusVerify('admin'));

        Avtopark::delete((int)$this->data['id']);

        $_SESSION['result'] = 'Парк Удалён';

        header('Location: ../../catalog/park/all');

    }



}