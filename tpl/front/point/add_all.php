<?php
/**
 * Created by PhpStorm.
 * User: York
 * Date: 26.10.2015
 * Time: 12:18
 */
?>

<link rel="stylesheet" href="/assets/css/components/datepicker.css" type="text/css">
<link rel="stylesheet" href="/assets/css/components/datepicker.gradient.css" type="text/css">

<script src="/assets/js/ckeditor/ckeditor.js"></script>
<script src="/assets/js/components/datepicker.js"></script>

<div class="add-point-form-area">
<form method="post" class="uk-form uk-form-horizontal add-point-all" >
    <div class="uk-form-row ">
        <label class="uk-form-label">
            Название
        </label>
        <div class="uk-form-controls">
            <input type="text" name="Point[title]">
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" style="float: none">
            Описание
        </label>
        <div class="uk-form-controls" style="margin-left: 0;">
            <textarea id="ckeditor" name="Point[text]"></textarea>
        </div>
    </div>
    <div class="uk-form-row ">
        <label class="uk-form-label">
            Адрес
        </label class="uk-form-label">
        <div class="uk-form-controls">
            <input type="text" class="point-find-prop-text" name="Point[address]">
            <input type="button" class="point-find-prop uk-button" value="Найти объект">
        </div>
    </div>
    <div class="uk-form-row ">
        <label class="uk-form-label">
            Категория
        </label>
        <div class="uk-form-controls">
            <select>
                <option value="0">Выбрать категорию</option>
                <?foreach($data['categories_list'] as $cat):?>
                    <option value="<?=$cat['id']?>"><?=$cat['name']?></option>
                <?endforeach?>
            </select>
        </div>
    </div>
    <div class="uk-form-row date-min-row">
        <label class="uk-form-label">
            Сроки
        </label>
        <div class="uk-form-controls">
            <span class="text-before-date">от</span> <input type="text" class="point-date-start" name="Point[date_start]" data-uk-datepicker="{format:'DD.MM.YYYY'}" />
        </div>
    </div>
    <div class="uk-form-row date-min-row">
        <label class="uk-form-label">
            <input type="checkbox" class="point-no_limit" name="Point[no_limit]">  Бессрочная
        </label>
        <div class="uk-form-controls">
            <span class="text-before-date">до</span> <input type="text" class="point-date-end" name="Point[date_end]" data-uk-datepicker="{format:'DD.MM.YYYY'}" />
        </div>
    </div>
</form>

</div>
<div class="add-point-map-area">
    <div id="map" class="add-point-map"></div>
</div>
<div class="clear"></div>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript" charset="UTF-8" src="<?= ASSET_FRONT_DIR ?>/js/map.js"></script>
<script type="text/javascript" charset="UTF-8" src="<?= ASSET_FRONT_DIR ?>/js/add_point.js"></script>