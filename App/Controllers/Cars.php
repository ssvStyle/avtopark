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

    public function delete()
    {
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