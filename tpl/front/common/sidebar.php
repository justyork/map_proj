<h3>Navigation</h3>
<ul class="uk-nav uk-nav-side ">
    <?foreach($menu as $key => $value):?>
        <li class="<?=$_SERVER['REQUEST_URI'] == '/'.$value[0] ? 'uk-active' : ''?>"><a href="/<?=$value[0]?>"><?=$key?></a></li>
    <?endforeach?>
</ul>
