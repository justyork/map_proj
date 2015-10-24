<html lang="en-gb" dir="ltr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>

    <link rel="stylesheet" href="/css/uikit.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/css/uikit.almost-flat.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/css/uikit.gradient.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/css/components/notify.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/css/components/notify.almost-flat.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/css/components/notify.gradient.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/css/style.css" type="text/css" media="screen" />
    <script language="JavaScript" type="text/javascript" src="/js/jquery.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/uikit.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/components/grid.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/components/notify.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/jquery.validate.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/admin.js"></script>

</head>
<body>

<?if(!empty($errors)):?>
    <div class="uk-form-row">
        <?foreach($errors as $err):?>
            <li><?=$err?></li>
        <?endforeach?>
    </div>
<?endif?>

<div class="uk-grid">
    <div class="uk-width-1-1 header" >
        <?=JL::renderPart('/common/header', array('roleName' => $roleName, 'admin' => true))?>
    </div>
    <div class="uk-width-1-5 sidebar" >
        <?=JL::renderPart('/common/sidebar', array('menu' => $menuAdmin))?>

    </div>
    <div class="uk-width-4-5 content" >
        <?=$content?>
    </div>

</div>
<div id="messages" class="uk-offcanvas">
    <div class="uk-offcanvas-bar uk-offcanvas-bar-flip">
        <div class="messagesForm">
            <form class="uk-form">
                <input type="text" class="" />
                <input type="submit" value="Send" class="uk-button uk-button-success" />
            </form>
        </div>
    </div>
</div>
</body>
</html>