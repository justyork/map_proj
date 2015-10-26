<?php
/**
 * Created by PhpStorm.
 * User: York
 * Date: 01.09.2015
 * Time: 13:30
 */
class Debug{

    public static function PDOQuery($q, $params = false){

        if($params){
            foreach($params as $key => $val){
                $q = str_replace(':'.$key, $val, $q);
            }
        }
        return $q;
    }
}