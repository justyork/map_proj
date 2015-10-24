$(document).ready(function(){
    /** ИНИЦИАЛИЗАЦИЯ КАРТ**/
    var map = new ymaps.Map("map", {
        center: [52.27171793, 104.28104720],
        zoom: 12
    });

    function init(){
        myMap = new ymaps.Map("map", {
            center: [55.76, 37.64],
            zoom: 7
        });
    }
    ymaps.ready(init);
    var myMap;

})
