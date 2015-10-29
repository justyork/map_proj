$(document).ready(function(){

    if($('#ckeditor').val() != null){
        CKEDITOR.replace( 'ckeditor', {
            uiColor: '#ffffff',
            height: 150,
            width: 400
        } );

    }


})
