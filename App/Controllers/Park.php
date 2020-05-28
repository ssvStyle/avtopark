<?php

namespace App\Controllers;

use Core\BaseController;

class Park extends BaseController
{

    public function showAll()
    {
        return $this->view->display('park.html.twig');
    }

    public function create()
    {

        if (empty($_POST['avtoparkName']) && isset($_POST['save'])) {

            $this->view->addGlobal(
                'errors', [
                'name' => 'Пустое поле название!!!',
                'avto' => 'empty field',
                //'adres' => 'empty field'
            ]);



        }

        $this->view->addGlobal('avtoparkName', $_POST['avtoparkName'] ?? '');

        return $this->view->display('createPark.html.twig');
    }

}