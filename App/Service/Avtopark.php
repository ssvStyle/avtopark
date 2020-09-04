<?php

namespace App\Service;

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

        if ($park) {
            
            return $park[0];
            
        }

    }

    public static function savePark(array $post)
    {
        $db = new Db();

        $data = [
            ':name' => $post['avtoparkName'],
            ':adres' => $post['avtoparkAdres'],
            ':schedule' => $post['avtoparkSchedule'],
            ':time' => time(),
        ];

        $sql = 'INSERT INTO park (name, adres, schedule, created_at) VALUES (:name, :adres, :schedule, :time)';

        $db->execute($sql, $data);

        $lastParkId = $db->getLastInsertId();

        if (isset($post["new_avto_num"], $post["new_avto_name"])) {

            $newAvto = array_combine($post['new_avto_num'], $post['new_avto_name']);

            $newAvtolastId = [];

            foreach ($newAvto as $num => $name){

                $sql = 'INSERT INTO avto (num, name) VALUES (:num, :name)';

                $db->execute($sql, [':num' => $num, ':name' => $name]);

                $newAvtolastId[] = $db->getLastInsertId();

            }

            $values = [];

            foreach ($newAvtolastId as $id) {

                $values[] = ' (\''.$lastParkId.'\', \''.$id.'\')';

            }

            $sql = 'INSERT INTO avtopark (park_id, car_id) VALUES ' . implode(',' , $values);

            $db->execute($sql, []);
        }

    }

    public static function saveCar(array $post)
    {

    }

    public static function updatePark(array $post)
    {
        $db = new Db();

        if (isset($post['edit_avto_id'], $post['edit_avto_num'], $post['edit_avto_name'])){

            self::updateCar($post['edit_avto_id'], $post['edit_avto_num'], $post['edit_avto_name']);

        }

        $data = [
            ':id' => $post['avtoparkId'],
            ':name' => $post['avtoparkName'],
            ':adres' => $post['avtoparkAdres'],
            ':schedule' => $post['avtoparkSchedule'],
            ':time' => time(),
        ];

        $sql = 'UPDATE park SET name = :name, adres = :adres, schedule = :schedule, updatet_at = :time WHERE park.id = :id';

        $db->execute($sql, $data);

        $lastParkId = $post['avtoparkId'];



        if (isset($post["new_avto_num"], $post["new_avto_name"])) {

            $newAvto = array_combine($post['new_avto_num'], $post['new_avto_name']);

            $newAvtolastId = [];

            foreach ($newAvto as $num => $name) {

                $sql = 'INSERT INTO avto (num, name) VALUES (:num, :name)';

                $db->execute($sql, [':num' => $num, ':name' => $name]);

                $newAvtolastId[] = $db->getLastInsertId();

            }

            $values = [];

            foreach ($newAvtolastId as $id) {

                $values[] = ' (\'' . $lastParkId . '\', \'' . $id . '\')';

            }

            $sql = 'INSERT INTO avtopark (park_id, car_id) VALUES ' . implode(',', $values);

            $db->execute($sql, []);
        }
    }

    public static function updateCar(array $id, array $num, array $name)
    {

        $db = new Db();

        foreach ($id as $k => $carId) {

            $sql = 'UPDATE avto SET num = :num, name = :name WHERE avto.id = :carId';

            $db->execute($sql, [':num' => $num[$k], ':name' => $name[$k], ':carId' => $carId]);

        }


    }

    public static function decoupleCarFromPark( int $parkId, int $carId)
    {

        $db = new Db();

        $sql = 'DELETE FROM avtopark WHERE park_id = :parkId AND car_id = :carId';

        return $db->execute($sql, [':parkId' => $parkId, ':carId' => $carId]);
        
    }

    public static function linkCarTooPark(int $carId, int $parkId)
    {

    }

    public static function delete(int $id)
    {

        $db = new Db();

        $sql = 'DELETE FROM park WHERE park.id = :id';

        $db->execute($sql, [':id' => $id]);

    }

    public static function delCar(int $id)
    {

        $db = new Db();

        $sql = 'DELETE FROM avto WHERE avto.id = :id';

        return $db->execute($sql, [':id' => $id]);

    }


}