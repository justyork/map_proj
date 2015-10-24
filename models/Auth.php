<?php
/**
 * Created by PhpStorm.
 * User: York
 * Date: 19.04.2015
 * Time: 1:29
 */

class Auth {

    public static $actions;

    public static $roleName = array(
        1 => 'Programmer',
        2 => 'Trader',
        3 => 'Main Trader',
        4 => 'Account manager',
        5 => 'Manger'
    );

    /**
     * Авторизация
     *
     * @param $login
     * @param $password
     * @return bool
     */
    public static function Login($login, $password){
        global $DB;

        $STH = $DB->prepare('SELECT * from `users` WHERE `email` = :login');
        $STH->execute(array(':login' => $login));

        $user = $STH->fetch();

        if(!$user)
            return 'Incorrect user';


        $must_be = sha1(sha1($password.$user['salt']).SECRET_KEY);
        if($user['password'] != $must_be){
            return 'Incorrect user';
        }

        $hash = sha1(JL::Random(20));
        $data = array('hash' => $hash, 'time' => time(), 'ip' => $_SERVER['REMOTE_ADDR']);

        $STH = $DB->prepare("UPDATE `users` SET `hash` = :hash, `last_login` = :time, `ip` = :ip");
        $STH->execute($data);

        setcookie("id", $user['id'], time()+60*60*24);
        setcookie("hash", $hash, time()+60*60*24);

        $_SESSION['user']['name'] = $user['name'];
        $_SESSION['user']['avatar'] = $user['name'];
        $_SESSION['user']['role'] = $user['role'];
        return true;

    }

    /**
     * Проверить пользователя
     *
     * @return bool
     */
    public static function Check(){
        global $DB;

        if(!isset($_SESSION['user']))
            return false;

        if (isset($_COOKIE['id']) && isset($_COOKIE['hash'])){
            $STH = $DB->prepare('SELECT * from `users` WHERE `id` = :id');
            $STH->execute(array(':id' => $_COOKIE['id']));
            $user = $STH->fetch();

            if(($user['hash'] !== $_COOKIE['hash']) || ($user['id'] !== $_COOKIE['id'])
                || $user['role'] !== $_SESSION['user']['role']
                || (($user['ip'] !== $_SERVER['REMOTE_ADDR'])  && ($user['ip'] !== "0"))){
                self::Logout();
                return false;
            }

            return true;
        }
        else
            return false;
    }

    public static function Logout(){
        setcookie("id", "", time() - 3600*24*30*12, "");
        setcookie("hash", "", time() - 3600*24*30*12, "");
    }

    public static function Can($action){

        $role = $_SESSION['user']['role'];
        $act_list = self::$actions;

        if(in_array($action, $act_list[$role]))
            return true;

        return false;

    }



    public static function PrepareAuth(){
        global $DB;

        $action_role_db = $DB->query('SELECT * from `action_role`');
        $actions_db = $DB->query('SELECT * from `actions`');

        $act_list = array();
        foreach($actions_db->fetchAll() as $act)
            $act_list[$act['id']] = $act['name'];

        $actions = array();
        foreach($action_role_db->fetchAll() as $act)
            $actions[$act['id_role']][] = $act_list[$act['id_action']];

        self::$actions = $actions;
    }
} 