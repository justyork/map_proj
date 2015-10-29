<?php
/**
 * Created by PhpStorm.
 * User: York
 * Date: 28.10.2015
 * Time: 17:15
 */

class Categories {

    /**
     * Получить все категории
     */
    public static function GetAll(){
        $sth = DB::query("SELECT * FROM categories");
        return $sth->fetchAll();
    }
} 