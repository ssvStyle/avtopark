<?php

namespace App\Servise;

use App\Models\Authorization as AuthModel;
use App\Models\Db;

class Validation
{

    public static function avtopark($post)
    {

        $err = [];
        $emptyField = 'Пустое поле';


        if (empty(trim($post['avtoparkName']))) {
            $err[] = $emptyField . ' "Название"';
        }

        if (empty(trim($post['avtoparkAdres']))) {
            $err[] = $emptyField . ' "Адрес"';
        }

        if (isset($post['new_avto_num'], $post['new_avto_name'])){

            $avto = array_combine($post['new_avto_num'], $post['new_avto_name']);

            foreach ( $avto as $k => $v ) {

                if (empty(trim($k))) {
                    $err[] = $emptyField . ' "Номер машины"';
                }

                if (empty(trim($v))) {
                    $err[] = $emptyField . ' "Имя водителя"';
                }
            }
        }

        return $err;

    }

    public static function checkFormAuth ($post)
    {
        $data = [];
        $data['errors'] = [];
        $data['login'] = $post['login'] ?: false;
        $data['pass'] = $post['pass'] ?: false;
        $data['remember'] = $post['rememberMe'] ?? false;

        if (empty($data['login'])) {
            $data['errors'][] = 'Поле логин не заполнено!';
        } else {
            $auth = new AuthModel(new Db());

            if (!$auth->loginExist($data['login'])) {
                $data['errors'][] = 'Пользователя с таким логином не существует!';
            }
            if (!$auth->loginAndPassValidation($data['login'], $data['pass'])) {
                $data['errors'][] = 'Неверный пароль';
            }
        }

        if (empty($data['pass'])) {
            $data['errors'][] = 'Поле пароль не заполнено!';
        }

        return $data;
    }

}