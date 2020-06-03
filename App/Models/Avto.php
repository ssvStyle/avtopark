<?php

namespace App\Models;

class Avto extends Model
{
    const TABLE = 'avto';

    public function getParks()
    {
        $db = new Db();

        $sql = 'SELECT park.id, name, adres, schedule
                FROM avtopark
                LEFT JOIN park ON avtopark.park_id = park.id
                WHERE avtopark.car_id = :id';

        return $db->queryRetObj($sql, [':id' => $this->id ], 'App\Models\Avto');

    }
}