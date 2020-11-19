<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Каталог</title>
    <link rel="stylesheet" type="text/css" href="{{ \Illuminate\Support\Facades\URL::asset('css/app.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

</head>
<body>
@include('nav')
<div class="wrapper">
    <div class="header">
        <div class="container">
            <h2>Каталог</h2>
        </div>
    </div>
    <div class="wrap">
        <div class="container">
            <div class="columns">
                <div class="column col-3">
                    <!-- filter -->
                    <div class="filter">
                        <!-- filter-item -->
                        <div class="filter-item">
                            <div class="filter-title">Размер</div>
                            <div class="filter-content">
                                <ul class="filter-list">
                                    <li>
                                        <input type="checkbox" id="filter-size-1">
                                        <label for="filter-size-1">1,5 спальный</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="filter-size-2">
                                        <label for="filter-size-2">2,0 спальный</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="filter-size-3">
                                        <label for="filter-size-3">2,0 спальный с евро</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="filter-size-4">
                                        <label for="filter-size-4">детский</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="filter-size-5">
                                        <label for="filter-size-5">евро</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="filter-size-6">
                                        <label for="filter-size-6">семейный</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- filter-item -->
                        <div class="filter-item">
                            <div class="filter-title">Ткань</div>
                            <div class="filter-content">
                                <ul class="filter-list">
                                    <li>
                                        <input type="checkbox" id="filter-tkan-1">
                                        <label for="filter-tkan-1">поплин</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="filter-tkan-2">
                                        <label for="filter-tkan-2">искусственный шелк</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="filter-tkan-3">
                                        <label for="filter-tkan-3">микросатин</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="filter-tkan-4">
                                        <label for="filter-tkan-4">полиэфирнохлопковая</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="filter-tkan-5">
                                        <label for="filter-tkan-5">перкаль</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="filter-tkan-6">
                                        <label for="filter-tkan-6">сатин-жаккард</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- filter-item -->
                        <div class="filter-item">
                            <div class="filter-title">Цена</div>
                            <div class="filter-content">
                                <div class="price">
                                    <input type="text" class="price-input ui-slider-min" value="0">
                                    <span class="price-sep"></span>
                                    <input type="text" class="price-input ui-slider-max" value="2000">
                                </div>
                                <div class="ui-slider"></div>
                                <script type="text/javascript">
                                    $('document').ready(function () {
                                        $('.ui-slider').slider({
                                            animate: false,
                                            range: true,
                                            values: [0, 2000],
                                            min: 0,
                                            max: 2000,
                                            step: 1,
                                            slide: function (event, ui) {
                                                if (ui.values[1] - ui.values[0] < 1) return false;
                                                $('.ui-slider-min').val(ui.values[0]);
                                                $('.ui-slider-max').val(ui.values[1]);
                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                        <!-- filter-item -->
                        <div class="filter-item">
                            <div class="filter-content">
                                <button class="btn">Сбросить фильтр</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column col-9">
                    <div class="columns">
                        <!--  -->
                        <div class="column col-4">
                            <div class="element">
                                <div class="element-image">
                                    <img src="https://avatars.mds.yandex.net/get-mpic/1923922/img_id3485673576547289781.jpeg/6hq" alt="">
                                </div>
                                <div class="element-title">
                                    <a href="">КПБ Бязь "Angelina"</a>
                                </div>
                                <div class="element-price">770 ₽</div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="column col-4">
                            <div class="element">
                                <div class="element-image">
                                    <img src="https://avatars.mds.yandex.net/get-mpic/1860966/img_id1637650940979850376.jpeg/6hq" alt="">
                                </div>
                                <div class="element-title">
                                    <a href="">КПБ "Радуга" (бязь 125гр., нав. 70/70 1 шт.)</a>
                                </div>
                                <div class="element-price">770 ₽</div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="column col-4">
                            <div class="element">
                                <div class="element-image">
                                    <img src="https://avatars.mds.yandex.net/get-mpic/1642819/img_id4084633023519379720.jpeg/6hq" alt="">
                                </div>
                                <div class="element-title">
                                    <a href="">КПБ страйп сатин "Мирослава" 1,5 сп.</a>
                                </div>
                                <div class="element-price">770 ₽</div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="column col-4">
                            <div class="element">
                                <div class="element-image">
                                    <img src="https://avatars.mds.yandex.net/get-mpic/2008455/img_id8334595496725266885.jpeg/6hq" alt="">
                                </div>
                                <div class="element-title">
                                    <a href="">КПБ Бязь "Золотая стрекоза"</a>
                                </div>
                                <div class="element-price">770 ₽</div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="column col-4">
                            <div class="element">
                                <div class="element-image">
                                    <img src="https://avatars.mds.yandex.net/get-mpic/1687058/img_id4020855627421849641.jpeg/6hq" alt="">
                                </div>
                                <div class="element-title">
                                    <a href="">КПБ пэ "Сказочный сон"</a>
                                </div>
                                <div class="element-price">770 ₽</div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="column col-4">
                            <div class="element">
                                <div class="element-image">
                                    <img src="https://avatars.mds.yandex.net/get-mpic/1864685/img_id3402628980077528742.jpeg/6hq" alt="">
                                </div>
                                <div class="element-title">
                                    <a href="">КПБ страйп сатин "Мирослава" 1,5 сп.</a>
                                </div>
                                <div class="element-price">770 ₽</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
