<?php

namespace App\Servise;

use App\Models\Db;

abstract class Avtopark
{
    public static function get(string $table)
    {
        $db = new Db();

        $sql = 'SELECT * FROM ' . $table;

        $park = $db->queryRetObj($sql, [], 'App\Models\\' . ucfirst($table));

        return $park;

    }

    public static function getById(int $id, string $table)
    {
        $db = new Db();

        $sql = 'SELECT * FROM ' . $table . ' WHERE id = :id';

        $park = $db->queryRetObj($sql, [ ':id' => $id], 'App\Models\\' . ucfirst($table));

        return $park[0];

    }

}