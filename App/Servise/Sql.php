<?php

namespace App\Servise;


class Sql
{

    public function all()
    {
        /**
         * SELECT
        `park`.`id`,
        `park`.`name`,
        `adres`,
        `schedule`,
        `avto_id`,
        `all_avto`.`num` AS `avto_num`,
        `all_avto`.`name` AS `avto_name`
        FROM `park`, `park_id` AS `park_avto`
        LEFT JOIN `avto` AS `all_avto` ON `all_avto`.`id` = `avto_id`
         */
    }

}