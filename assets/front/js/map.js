/**
 * Created by York on 24.10.2015.
 */

$(document).ready(function(){
    /** ИНИЦИАЛИЗАЦИЯ КАРТ**/
    ymaps.ready(init);
    var myMap;

    /** Смена города **/
    $('.city_select').change(function(){

    });
})


function init(){
    myMap = new ymaps.Map("map", {
        center: [52.27171793, 104.28104720],
        zoom: 12
    });
}