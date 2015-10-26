<?php
/**
 * Created by PhpStorm.
 * User: York
 * Date: 24.10.2015
 * Time: 21:43
 */

class DB {

    public static function query($q, $params = false){
        global $DB, $DBUG;

        $DBUG['query'][] = Debug::PDOQuery($q, $params);
        if(!$params)
            $sth = $DB->query($q);
        else{
            $sth = $DB->prepare($q);
            $sth->execute($params);
        }
        return $sth;
    }

    public static function make($q, $params = false){
        global $DB, $DBUG;

        $DBUG['query'][] = Debug::PDOQuery($q, $params);

        $sth = $DB->prepare($q);
        $sth->execute($params);
    }

} 