<?php

namespace App\Controllers;

use App\Service\Avtopark;
use Core\BaseController;
use App\Models\Db;

class Cars extends BaseController
{

    protected $authStatus;

    public function __construct()
    {
        parent::__construct();
        $this->authStatus = $auth = new \App\Models\Authorization(new Db());
    }

    public function showAll()
    {

        echo $this->view->display('cars.html.twig', [
            'cars' => Avtopark::get('avto'),
        ]);
    }

    public function delete()
    {
        $this->access($this->authStatus->userStatusVerify('admin'));

        if (isset($_POST['carId'])) {

            if (Avtopark::delCar( (int)$_POST['carId'])){

                echo 1;

            }

        } else {

            echo 'err';

        }

        die;
    }

    public function removeFromPark()
    {
        $this->access($this->authStatus->userStatusVerify('admin'));

        if (isset($_POST['parkId'], $_POST['carId'])) {

            if (Avtopark::decoupleCarFromPark((int)$_POST['parkId'], (int)$_POST['carId'])){

                echo 1;

            }

        } else {

            echo 'err';

        }

        die;

    }

}