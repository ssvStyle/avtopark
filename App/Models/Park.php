<?php

namespace App\Models;

class Park extends Model
{
    const TABLE = 'park';

    public function getCars()
    {
        $db = new Db();

        $sql = 'SELECT avto.id, num, name 
                FROM avtopark
                LEFT JOIN avto ON avtopark.car_id = avto.id
                WHERE avtopark.park_id = :id';

        return $db->queryRetObj($sql, [':id' => $this->id ], 'App\Models\Avto');

    }

}