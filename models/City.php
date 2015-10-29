<?php
/**
 * Created by PhpStorm.
 * User: York
 * Date: 24.10.2015
 * Time: 21:22
 */

class City {

    /**
     * Получить все города
     */
    public static function GetAll(){
        $sth = DB::query("SELECT * FROM city");
        return $sth->fetchAll();
    }

} 