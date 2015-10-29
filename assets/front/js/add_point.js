/**
 * Created by York on 28.10.2015.
 */

var apikey = 'AIzaSyDqp3nVGnMnj2QaPaur-bYhtS7KjO5a1f8';

$(document).ready(function(){
    $('.point-no_limit').change(function(){
        if($(this).is(':checked')){
            $('.point-date-end').attr('disabled', true);
        }
        else $('.point-date-end').removeAttr('disabled');
    });

    $('body').on('click', '.point-find-prop', function(){

        var search = $('.point-find-prop-text').val();
        $.post('/ajax/searchProperty', {search:search}, function(o){
            var json = JSON.parse(o);

            if(json.code == 200){

                myMap.geoObjects.removeAll();
                centerMapAndSetPoint(json.data.lat, json.data.lng);
            }
            else{
                $.post('https://maps.googleapis.com/maps/api/geocode/json?address='+search+'&key='+apikey, {}, function(o){

                    if(o.status == 'OK'){
                        o.search = search;
                        $.post('/ajax/saveQuery', o);
                        var coord = o.results[0].geometry.location;

                        myMap.geoObjects.removeAll();
                        centerMapAndSetPoint(coord.lat, coord.lng);
                    }

                });
            }


        })
    });
});