<html lang="en-gb" dir="ltr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/uikit.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/uikit.almost-flat.min.css" type="text/css">
    <link rel="stylesheet" href="<?= ASSET_FRONT_DIR ?>/css/style.css" type="text/css">
    <title><?= $title ?></title>
</head>
<body>

<header class="uk-form">
    <div id="header_top">
        <div class="header_wrap">
            <div class="header_block_left">
                <div class="wrap_city_select">
                    <select name="country" class="city_select">
                        <option>Москва</option>
                        <option>Иркутск</option>
                    </select>
                </div>
                <ul class="top_menu">
                    <li><a href="">Добавить акции</a></li>
                    <li><a href="">Новости</a></li>
                    <li><a href="">Вопросы и ответы</a></li>
                    <li><a href="">О сервисе</a></li>
                </ul>

                <div class="top_social_links">
                    <a href="" class="uk-icon-vk"></a>
                    <a href="" class="uk-icon-facebook"></a>
                    <a href="" class="uk-icon-twitter"></a>
                </div>
            </div>

            <div class="header_block_right">
                <div class="profile_menu">
                </div>

                <a href="#" class="login_top_button uk-button uk-button-success">Вход</a>
            </div>
        </div>
    </div>
    <div id="header_bot">
        <div class="header_wrap">
            <div class="site_logo">
                <a href="/"></a>
            </div>
            <div class="category_menu">
                <div class="uk-button-group">
                    <a class="uk-button" href="">Еда</a>
                    <a class="uk-button" href="">Одежда</a>
                    <a class="uk-button" href="">Развлечения</a>
                    <a class="uk-button" href="">Техника</a>
                    <a class="uk-button" href="">Красота</a>
                    <a class="uk-button" href="">Здоровье</a>
                    <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}" aria-haspopup="true" aria-expanded="false">
                        <button class="uk-button">Другое <i class="uk-icon-caret-down"></i></button>
                        <div class="uk-dropdown uk-dropdown-bottom">
                            <ul class="uk-nav uk-nav-dropdown">
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Another item</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="top_search">
                <div class="uk-form-icon">
                    <i class="uk-icon-search"></i>
                    <input type="text">
                </div>
            </div>

        </div>
    </div>
</header>
<aside id="wrap">
    <div id="map" width="748" height="498"></div>
    <div id="search_bar"></div>
    <div id="banner"></div>
</aside>

<footer>

</footer>


<script type="text/javascript" charset="UTF-8" src="/assets/js/jquery.js"></script>
<script type="text/javascript" charset="UTF-8" src="/assets/js/uikit.min.js"></script>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript" charset="UTF-8" src="<?= ASSET_FRONT_DIR ?>/js/map.js"></script>

</body>
</html>
