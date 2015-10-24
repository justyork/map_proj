
<html>
<head>
    <meta charset="utf-8"/>
    <title><?=$title?></title>

    <link rel="stylesheet" href="/css/uikit.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/css/style.css" type="text/css" media="screen" />
    <script language="JavaScript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/uikit.js"></script>

</head>
<body>
    <form class="uk-form login_form" method="post">
        <fieldset>
            <legend><?=PROJECT_NAME?></legend>
            <?if(!empty($errors)):?>
                <div class="uk-form-row">
                    <?foreach($errors as $err):?>
                        <li><?=$err?></li>
                    <?endforeach?>
                </div>
            <?endif?>
            <div class="uk-form-row"><input type="text" name="login" placeholder="Email"></div>
            <div class="uk-form-row"><input type="password" name="password" placeholder="Password"></div>
            <div class="uk-form-row"><input class="uk-button" type="submit" value="Login"></div>
        </fieldset>
    </form>
</body>
</html>