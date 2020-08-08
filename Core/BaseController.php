<?php

namespace Core;

use App\View;
use Core\Interfaces\BaseController as BaseControllerInterfase;
use App\Models\Authorization as AuthModel;
use App\Models\Db;


abstract class BaseController implements BaseControllerInterfase
{
    /*
     *$data for transfer to all classes of controllers
     */

    public $data;

    /*
     *$view obj for transfer to all classes of controllers
     */

    public $view;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');

        $this->view = new \Twig\Environment($loader, [
            'cache' => 'cache',
            'auto_reload' => true
            ]);

        $this->view->addGlobal('host', require __DIR__.'/../config/host.php');

        $auth = new AuthModel(new Db());

        if ($auth->userVerify()) {

            $this->view->addGlobal('auth', true);

        } else {

            $auth->exitAuth();

        }

    }

    /**
     * @param array $data
     */
    public function setData(array $data = [])
    {
        $this->data = $data;
    }

}