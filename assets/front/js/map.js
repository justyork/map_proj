/**
 * Created by York on 24.10.2015.
 */

$(document).ready(function(){
    /** ИНИЦИАЛИЗАЦИЯ КАРТ**/

    ymaps.ready(init);
    var myMap, myGeoObject, mainObject;

    /** Смена города **/
    $('.city_select').change(function(){

    });
})


function init(){
    myMap = new ymaps.Map("map", {
        center: [52.27171793, 104.28104720],
        zoom: 12
    });

    //myGeoObject = new ymaps.GeoObject({
    //    geometry: {
    //        type: "Point"// тип геометрии - точка
    //    }
    //});
    //mainObject = myMap.geoObjects.add(myGeoObject); // Размещение геообъекта на карте.


    /**
     *  myPlacemark = new ymaps.Placemark([55.76, 37.64], { content: 'Москва!', balloonContent: 'Столица России' });
     */
}

function centerMapAndSetPoint(lat, lng){
    myMap.setCenter([lat, lng], 17);

    myGeoObject = new ymaps.GeoObject({
        geometry: {
            type: "Point",// тип геометрии - точка
            coordinates: [lat, lng] // координаты точки
        }
    });

    myMap.geoObjects.add(myGeoObject); // Размещение геообъекта на карте.
}