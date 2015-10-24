<?php
/**
 * Created by PhpStorm.
 * User: York
 * Date: 26.04.2015
 * Time: 9:27
 */

class Users {

    public static function Delete(){
        global $DB;
        try{
            $userD = $DB->prepare("DELETE FROM users WHERE id = :id");
            $userD->execute(array('id' => $_GET['id']));
        }
        catch(PDOException $e){
            die("We have a problems! Notify administrators this issue. Code 103");
        }
    }

    /**
     * Генерация пароля для пользователя
     *
     * @param $user_id
     */
    public static function GeneratePassword($user_id){
        global $DB;

        $userQ = $DB->prepare("SELECT * FROM users WHERE id = :id");
        $userQ->execute(array(':id' => $user_id));

        $user = $userQ->fetch();

        $salt = $user['salt'];
        $data = array(':id' => $user_id);
        $query = "UPDATE users SET ";

        if(empty($user['salt'])){
            $query .= "salt = :salt, ";
            $salt = JL::Random(32);
            $data['salt'] = $salt;
        }
        $new_pwd = JL::Random(10);

        $password = sha1(sha1($new_pwd.$salt).SECRET_KEY);
        $data['password'] = $password;

        $query .= "password = :password WHERE id = :id";
        $userU = $DB->prepare($query);
        $userU->execute($data);

        $msg = "Your password have been changed. \n\rNew password: {$new_pwd}";
        Mail::send($user['email'], 'New password', $msg, 'Ankorinvest');
    }

    public static function Get(){
        global $DB;
        $data = $DB->query('SELECT * FROM `users`');
       return $data->fetchAll();
    }

    public static function Registration($data){
        global $DB;

        $data['status'] = isset($data['status']) ? 1 : 0;

        $salt = JL::Random(32);
        $new_pwd = JL::Random(10);
        $password = sha1(sha1($new_pwd.$salt).SECRET_KEY);
        $data['salt'] = $salt;
        $data['password'] = $password;

        try{
            $sth = $DB->prepare('INSERT INTO users (`name`, role, email, phone, skype, status, salt, password)
                                      VALUES (:name, :role, :email, :phone, :skype, :status, :salt, :password)');

            $sth->execute($data);
        }
        catch(PDOException $e){
            die('We have a problems! Notify administrators this issue. Code 101');
        }

        $msg = "You are logged in Ankorinvest.\n\r
Your login: {$data['email']} \n\r
Your password: {$new_pwd}";

        Mail::send($data['email'], 'New password', $msg, 'Ankorinvest');
    }

    public static function Update($user_id, $data){
        global $DB;
        $data['status'] = isset($data['status']) ? 1 : 0;
        $data['id'] = $user_id;

        try{
            $sth = $DB->prepare('UPDATE users SET name = :name, role = :role, phone = :phone, skype = :skype, status = :status, email = :email WHERE id = :id');
            $sth->execute($data);
        }
        catch(PDOException $e){
            die('We have a problems! Notify administrators this issue. Code 102');
        }
    }
} 