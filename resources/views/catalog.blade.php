@extends('layout')
@section('titlesection')Каталог
@endsection
@section('content')
<div class="wrapper">
    <div class="header">
        <div class="container">
            <h2>Каталог</h2>
        </div>
    </div>
    <div class="wrap" id="wrap_id">
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
                                    @foreach($sizes as $size) {{-- all sizes --}}
                                    @if(in_array($size->id, $attached_sizes)) {{-- attached ones ids --}}
                                        <li>
                                            <input onclick="filter(get_data_for_post())" type="checkbox" value="{{$size->code}}" name="razmer[]" id="filter-size-{{$size->id}}">
                                            <label for="filter-size-{{$size->id}}">{{$size->name}}</label>
                                        </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- filter-item -->
                        <div class="filter-item">
                            <div class="filter-title">Ткань</div>
                            <div class="filter-content">
                                <ul class="filter-list">
                                    @foreach($materials as $material) {{-- all materials --}}
                                        @if(in_array($material->id, $attached_materials)) {{-- attached ones ids --}}
                                            <li>
                                                <input onclick="filter(get_data_for_post())" type="checkbox" value="{{$material->code}}" name="tkan[]" id="filter-material-{{$material->id}}">
                                                <label for="filter-material-{{$material->id}}">{{$material->name}}</label>
                                            </li>
                                        @endif
                                    @endforeach
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
                                    $('document').ready(
                                        function () {
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
                                                },
                                                change: function (event, ui) {
                                                    my_wait(500);
                                                    if (!event.originalEvent) { return; }
                                                    else filter(get_data_for_post());
                                                }
                                            });
                                        });
                                </script>
                            </div>
                        </div>
                        <!-- filter-item -->
                        <div class="filter-item">
                            <div class="filter-content">
                                <button onclick="" class="btn fall">Сбросить фильтры</button>
                                <script type="text/javascript">

                                $('.fall').ready().on('click', function() {
                                    refresh();
                                });
                                </script>
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
@endsection
<script type="text/javascript">

    /* Sets input values to empty / defaults */
    function refresh() {
        $('input[type=checkbox]').prop("checked", false );  /* clean up */
        $('.ui-slider').slider( "values", 0, 0 );
        $('.ui-slider').slider( "values", 1, 2000 );        /* not leads to slider.change */
        $('.ui-slider-min').val('0');
        $('.ui-slider-max').val('2000');
        filter(get_data_for_post());                        /* start new filter */
    }

    function my_ok_callback(response_code, responseText, url) {
        console.log('\r\nresponseText' + responseText);
    }

    function my_wait(ms) {
        const milliseconds = ms;
        const date = Date.now();
        let currentDate = null;
        do { currentDate = Date.now();
        } while (currentDate - date < milliseconds);
    }

    function get_data_for_post() {
        let collected_data = {
            razmer : [],
            tkan : [],
            priceFrom : [],
            priceTo : [],
        };

        collected_data.priceFrom.push($('.ui-slider-min').val());
        collected_data.priceTo.push($('.ui-slider-max').val());

        document.querySelectorAll('input[type=checkbox]').forEach(function(box) {
            if (box.checked) {
                if (box.name === 'razmer[]') {
                    collected_data.razmer.push(box.value);
                }
                if (box.name === 'tkan[]')
                    collected_data.tkan.push(box.value);
            }
        });
        return collected_data;
    }


    /* ON POPSTATE */
    window.onpopstate = function(event) {
        if (event.state === null) {
            refresh();
        }
        if (event.state) {
            let filter_data = event.state.filter_data;

            document.querySelectorAll('[name="razmer[]"]').forEach(function(razmer) {
                // if still checked, but should not be, for it is not belongs this page
                if (razmer.checked && filter_data.razmer.includes(razmer.value) == false) {
                    $(razmer).prop("checked", false);
                }
            });

            document.querySelectorAll('[name="tkan[]"]').forEach(function(tkan) {
                if (tkan.checked && filter_data.tkan.includes(tkan.value) == false) {
                    $(tkan).prop("checked", false);
                }
            });

            $('.ui-slider-min').prop('value', filter_data.priceFrom[0]);
            $('.ui-slider').slider('values', 0, filter_data.priceFrom[0]);

            $('.ui-slider-max').prop('value', filter_data.priceTo[0]);
            $('.ui-slider').slider('values', 1, filter_data.priceTo[0]);

            filter(get_data_for_post(), true);
        }
    };

    /**
     * Updates data bundle, page url and filter state before making (or not making) http-request .
     * @param {Object} filter_data - bundle object, accumulates filter data before request.
     * @param {boolean} from_popstate - does filter called by page input changes or by browser 'back' button.
     * @param {function} callback
     */
    function filter(filter_data, from_popstate = false, callback = my_ok_callback) {
        let post_data = {
            _token: '{{csrf_token()}}',
            url: '{{url('/')}}' + '/',
        };

        let post_body;
        let post_url = post_data.url + 'filter';
        let formed_url = post_data.url + 'catalog';
        let filter_is_empty = true;
        let bundle;

        if (filter_data.razmer !== undefined) {
            bundle = add_to_request_by_type(
                'razmer', post_body, formed_url, filter_data.razmer, filter_is_empty); // true for the first call
            formed_url = bundle !== undefined ? bundle.url : formed_url;
            post_body = bundle !== undefined ? bundle.body : post_body;
            filter_is_empty = bundle !== undefined ? bundle.is_empty : true;
        }

        if (filter_data.tkan !== undefined) {
            bundle = add_to_request_by_type(
                'tkan', post_body, formed_url, filter_data.tkan, filter_is_empty);
            formed_url = bundle !== undefined ? bundle.url : formed_url;
            post_body = bundle !== undefined ? bundle.body : post_body;
            filter_is_empty = bundle !== undefined ? bundle.is_empty : true;
        }

        if (filter_data.priceFrom !== undefined) {
            bundle = add_to_request_by_type(
                'priceFrom', post_body, formed_url, filter_data.priceFrom, filter_is_empty);
            formed_url = bundle !== undefined ? bundle.url : formed_url;
            post_body = bundle !== undefined ? bundle.body : post_body;
            filter_is_empty = bundle !== undefined ? bundle.is_empty : true;
        }

        if (filter_data.priceTo !== undefined) {
            bundle = add_to_request_by_type(
                'priceTo', post_body, formed_url, filter_data.priceTo, filter_is_empty);
            formed_url = bundle !== undefined ? bundle.url : formed_url;
            post_body = bundle !== undefined ? bundle.body : post_body;
            filter_is_empty = bundle !== undefined ? bundle.is_empty : true;
        }
        console.log('filter_is_empty as result ? ' + filter_is_empty);

        formed_url = formed_url.replace("&", "?");
        post_data.url = formed_url;
        console.log('formed_url!\n' + formed_url);

        if (!from_popstate) // if called not from browser window history, push
            push_state({
                url : formed_url,
                filter_data : filter_data,
            }, formed_url);

        /* post request */
        let xmlHttp = new XMLHttpRequest();
        let boundary = String(Math.random()).slice(2);
        let boundaryMiddle = '--' + boundary + '\r\n';
        let boundaryLast = '--' + boundary + '--\r\n'

        for (let key in post_data) {
            post_body.push('Content-Disposition: form-data; name="'
                + key + '"\r\n\r\n' + post_data[key] + '\r\n');
        }

        post_body = post_body.join(boundaryMiddle) + boundaryLast;
        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4)
                callback(xmlHttp.response.code, xmlHttp.responseText, formed_url);
        }

        xmlHttp.open("POST", post_url, true);
        xmlHttp.setRequestHeader('Content-Type', 'multipart/form-data; boundary=' + boundary);
        xmlHttp.send(post_body);
    }

    /**
     * Updates data bundle, page url and filter state before making (or not making) http-request .
     * @param {string} f_type - filter-data type collected form inputs.
     * @param {Object} post_body - bundle object, accumulating filter data before request.
     * @param {string} formed_url - url being formed accordingly to filter.
     * @param {Array} field_values - (string) array of input 'values'.
     * @param {boolean} filter_is_empty - current filter state.
     * @return {Object} post_data_bundle object.
     */
    function add_to_request_by_type(f_type, post_body, formed_url, /* [] */ field_values, filter_is_empty = false) {
        post_body = filter_is_empty ? ['\r\n'] : post_body;
        let post_data_bundle = {
            body: post_body,
            url: formed_url,
            is_empty: field_values == false && filter_is_empty,
        };

        if (field_values == false) { return post_data_bundle; }

        const conditions = (price) => ( (f_type !== 'priceFrom' && f_type !== 'priceTo') ||
            (price != '0' && f_type === 'priceFrom') || (price != '2000' && f_type === 'priceTo') );

        let is_not_default_price = field_values.every(conditions);

        if (is_not_default_price)
            formed_url = formed_url.concat('&', f_type, '=');

        field_values.forEach( (code) => { if (is_not_default_price)
            formed_url = formed_url.concat(code, ',');
        });

        if (is_not_default_price)
            formed_url = formed_url.slice(0, -1);

        field_values.forEach( (code) => { if (is_not_default_price)
            post_body.push('Content-Disposition: form-data; name="' + f_type + '[]"\r\n\r\n' + code + '\r\n');
        });

        post_data_bundle.body = post_body;
        post_data_bundle.url = formed_url;
        return post_data_bundle;
    }

    function push_state (data, url) {
        history.pushState(data, 'filter!', url);
    }
</script>
