<?php
/**
 * Created by PhpStorm.
 * User: York
 * Date: 28.10.2015
 * Time: 17:16
 */
global $DBUG;
$debug = $DBUG;
?>

<script>
    $(document).ready(function(){

        var debug_table = $.cookie('debug-table');
        $('body').on('click', '.debug-closed-button', function(){

            $('.debug-wrap').hide();
            $('.debug-open-button').show();
            $.cookie('debug-table', 'close', {path:'/'});
        })
        $('body').on('click', '.debug-open-button', function(){
            $('.debug-wrap').show();
            $('.debug-open-button').hide();
            $.cookie('debug-table', 'open', {path:'/'});
        })


        if(debug_table && debug_table == 'close'){
            $('.debug-wrap').hide();
            $('.debug-open-button').show();
        }
    })
</script>

<button  class="debug-open-button"><</button>
<div class="debug-wrap">
    <button  class="debug-closed-button">></button>
    <h2>SQL queries</h2>
    <ul>
        <?foreach($debug['query'] as $q):?>
            <li><span><?=$q?></span></li>
        <?endforeach?>
    </ul>
</div>