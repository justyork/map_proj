<?php
/**
 * Created by PhpStorm.
 * User: York
 * Date: 29.10.2015
 * Time: 0:08
 */

class Addresses {
    private static  $_table_name = 'addresses';

    /**
     * @param $search
     * @return bool
     *
     * Поиск запроса по базе
     */
    public static function Search($search){

        $sth = DB::query("SELECT * FROM ".self::$_table_name." WHERE `name` = :name", array('name' => mb_strtolower($search)) );
        $data = $sth->fetch();
        if($data)
            return $data;

        return false;

    }

    public static function SaveAddressesByGoogle($search, $results){

        foreach($results as $res){
            $obj = array(
                'name' => $search,
                'lat' => $res['geometry']['location']['lat'],
                'lng' => $res['geometry']['location']['lng'],
                //'city' => $res,
                'gdata' => json_encode($res),
            );

            $q = "INSERT INTO ".self::$_table_name." ".DB::insertFieldsByArr($obj);
            DB::make($q, $obj);
        }

    }
} 