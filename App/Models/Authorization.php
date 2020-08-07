<?php

namespace App\Models;

use \App\Models\Db as db;

class Authorization
{
    protected $db;
    protected $login;
    protected $pass;
    protected $hash;
    protected $user;

    /**
     * AuthServise constructor.
     * @param \App\Models\Db $db
     *
     */
    public function __construct(Db $db)
    {
            $this->db = $db;

    }

    /**
     * @param $hash
     * 
     * @return bool
     */
    public function userVerify()
    {
        $hash = $_SESSION['UserHash'] ?: null;

        if ($hash !== null) {

            $sql = 'SELECT * FROM users WHERE hash=:hash';

            if ($this->db->execute($sql, [':hash' => $hash])) {

                return true;

            }
        }

        return false;
        
    }

    /**
     * @param $login
     * 
     * @return bool
     */
    public function loginExist($login)
    {

        $sql = 'SELECT * FROM users WHERE login=:login';

        if($this->db->execute($sql, [':login' => $login])) {

            return true;

        }
        return false;
        
    }

    /**
     * @param $login
     * @param $pass
     *
     * @return bool
     */

    public function loginAndPassValidation($login, $pass)
    {
        if ($this->loginExist($login)) {

            $sql = 'SELECT * FROM users WHERE login=:login';
            $user = $this->db->query($sql, [':login' => $login], '\App\Models\User')[0];

            if ( password_verify($pass, $user->getPass()) ) {
                $this->user = $user;
                return true;
            }

        }

        return false;

    }

    /**
     * @return bool
     */
    public function setAuth()
    {
        $hash = sha1(microtime() . rand(0, 1000000000));

        $sql = 'UPDATE users SET hash=:hash WHERE id=\''.$this->user->getId().'\'';

        if ($this->db->execute($sql, [':hash'=> $hash])) {

            $_SESSION['UserHash'] = $hash;
            return true;

        }

    }

    /**
     * @return bool
     */
    public function exitAuth()
    {
        $hashSession = $_SESSION['UserHash'] ?: null;

        $sql = 'UPDATE users SET hash=:hash WHERE hash=:hashSession';

        if ($this->db->execute($sql, [':hash'=> '', ':hashSession' => $hashSession])) {

            unset($_SESSION['UserHash']);
            session_regenerate_id(true);
            return true;

        }
    }



}