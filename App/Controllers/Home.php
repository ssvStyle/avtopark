<?php

namespace App\Controllers;

use Core\BaseController;

class Home extends BaseController
{

    public function index()
    {

        if (isset($_SESSION['Uid'])) {
            return $this->view
                ->render('index.html.twig');
        }

        header('Location: avtopark');

    }


}