<?php
/**
 * Created by PhpStorm.
 * User: York
 * Date: 26.10.2015
 * Time: 12:18
 *
 * Добавление акции
 *
 */
?>

<?if(!Auth::Check()):?>
    <?=JL::renderPart('front/point/add_all', array('data' => $data));?>

<?endif?>