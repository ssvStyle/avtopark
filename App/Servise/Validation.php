<?php

namespace App\Servise;

abstract class Validation
{

    public static function avtopark($post) {

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

}