@extends('layout')
@section('titlesection')Редактировать
@endsection
@section('content')

<div class="wrapper">
    <div class="header">
        <div class="container">
            <h2>Редактирование товара {{$good->id}} </h2>
        </div>
    </div>

    <div class="wrap">
        <div class="form container">
            <form method="POST" action="{{ route('good.update', ['good_id' => $good->id]) }}" class="form-horizontal" id="update-good" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Отображаемое имя</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="" name="name" value="{{ $good->name }}" form="update-good">
                        @error('name')
                        {{$message}}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Код</label>
                    <div class="col-sm-10">
                        <input id="code" value="{{ $good->code }}" type="text" class="form-control" placeholder="Код" name="code" form="update-good">
                        @error('code')
                        {{$message}}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Цена</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{$good->price}}" class="form-control" placeholder="" name="price" form="update-good">
                        @error('price')
                        {{$message}}
                        @enderror
                    </div>
                </div>

                <div class="form-group row ml-3">
                    <div class="col-md-10 float-right border border-black">
                        <div class="row pt-3">

                            @if($good->image != '')
                            <img class="col-md-4 img-fluid" src="{{ asset($good->image) }}">
                            @endif
                            <div class="col ml-auto">
                                <label class="col control-label">Новое фото?</label>
                                <div class="col-sm-10">
                                    <input id="img2" type="file" accept="image/*" class="form-control" placeholder="" name="image">
                                </div>
                                <div class="row col-7 mt-4 mr-3 pr-2 ml-auto">
                                    @if($good->image != '')
                                    <div class="col-9">
                                        <div onclick="post_request(my_ok_callback)"
                                        class="col-9 float-right btn pt-0 pb-1 small-button btn-danger">Удалить фото</div>
                                    </div>
                                        <script>
                                            function my_ok_callback(response_code, responseText, url) {
                                                console.log('eh url ' + url + '\nresponse_code ' + response_code + '\nresponseText' + responseText);
                                                this.window.location.href = url;
                                            }

                                            function post_request(callback) {
                                                let post_data = {
                                                    _token: '{{csrf_token()}}',
                                                    url: '{{url('/')}}' + '/image/delete/' + '{{$good->id}}',
                                                    good_id: '{{$good->id}}',
                                                };

                                                let post_body;
                                                let formed_url = this.window.location.href;

                                                    post_body = ['\r\n'];
                                                    post_body.push('Content-Disposition: form-data; name="good_id"\r\n\r\n'
                                                        + post_data['good_id'] + '\r\n');

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

                                                xmlHttp.open("POST", post_data.url, true); // true for asynchronous
                                                xmlHttp.setRequestHeader('Content-Type', 'multipart/form-data; boundary=' + boundary);
                                                xmlHttp.send(post_body);
                                            }
                                        </script>
                                    @endif
                                </div>
                            </div>

                            @if($good->image != '')
                            <label class="col-sm-10 ml-4 border border-black">{{asset($good->image)}}</label>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="float-right col-md-5 mx-4">
                        <div class="filter-title">Укажите доступные размеры:</div>
                        <div class="filter-content">
                            <ul class="filter-list">
                                @foreach($sizes as $size)
                                    @if(in_array($size->id, $good_size_ids))
                                    <li>
                                        <input type="checkbox" checked="checked" value="{{$size->id}}" name="sizes[]" id="filter-size-{{$size->id}}" form="update-good">
                                        <label for="filter-size-{{$size->id}}">{{$size->name}}</label>
                                    </li>
                                    @else
                                    <li>
                                        <input type="checkbox" value="{{$size->id}}" name="sizes[]" id="filter-size-{{$size->id}}" form="update-good">
                                        <label for="filter-size-{{$size->id}}">{{$size->name}}</label>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="float-right col-md-3 mx-4">
                        <div class="filter-title">Материал:</div>
                        <div class="filter-content">
                            <ul class="filter-list">
                                @foreach($materials as $material)
                                    @if(in_array($material->id, $good_material_ids))
                                    <li>
                                        <input type="checkbox" checked="checked" value="{{$material->id}}" name="materials[]" id="filter-material-{{$material->id}}" form="update-good">
                                        <label for="filter-material-{{$material->id}}">{{$material->name}}</label>
                                    </li>
                                    @else
                                    <li>
                                        <input type="checkbox" value="{{$material->id}}" name="materials[]" id="filter-material-{{$material->id}}" form="update-good">
                                        <label for="filter-material-{{$material->id}}">{{$material->name}}</label>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button form="update-good" type="submit" class="btn btn-default btn-sm">Сохранить</button>
                    </div>
                </div>
            </form>

            <form id="delete-good" method="POST" action="{{ route('good.delete', [ 'good_id' => $good->id ]) }}">
                {{ csrf_field() }}


                <script> function confirm_delete(){document.getElementById("myPopup").classList.toggle("show");}</script>
                <div class="col float-right">
                    <div class="col-5 mr-auto pt-2 pb-0 btn btn-default btn-md btn-danger" onclick="confirm_delete(this)">Удалить товар</div>
                    <div class="pop_div col-7 float-right" id="myPopup">Подтвердите действие...
                        <button class="pop_btn col-4 pt-0 pb-0 btn btn-default btn-md btn-danger" type="submit" form="delete-good">Удалить!</button>
                    </div>
                </div>

                <style>
                    .pop_div {
                        visibility: hidden;
                        z-index: 1;
                    }
                    .pop_div::after {
                        border-style: solid;
                        border-color: #555 transparent transparent transparent;
                    }
                    .show {
                        visibility: visible;
                        -webkit-animation: fadeIn 2s;
                        animation: fadeIn 2s;
                    }
                    @-webkit-keyframes fadeIn {
                        from {opacity: 0;}
                        to {opacity: 1;}
                    }

                    @keyframes fadeIn {
                        from {opacity: 0;}
                        to {opacity:1 ;}
                    }
                </style>

            </form>

        </div>
    </div>
</div>

@endsection('content')
