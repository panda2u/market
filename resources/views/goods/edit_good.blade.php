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
            <form action="{{ route('good.update', ['good_id' => $good->id]) }}" id="update-good" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="form-group">
                        <label class="col-m-2 control-label">Отображаемое имя (Сейчас -- {{$good->name}})</label>
                        <div class="col-sm-10">
                            <input id="name" type="text" class="form-control" placeholder="" name="name">
                            <label for="name" class="col-m-2">код: {{ $good->code }}</label><br>
                        </div>
                    </div>

                    <div id="img1" class=""><img class="img-fluid" src="{{ asset($good->image) }}"><br></div>
                    <label for="img1">{{$good->image}}</label>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Новое фото?</label>
                        <div class="col-sm-10">
                            <input id="img2" type="file" class="form-control" placeholder="" name="image">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Цена: (Сейчас -- {{$good->price}})</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="" name="price">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="float-right col-md-5 mx-4">
                            <div class="filter-title">Укажите доступные размеры:</div>
                            <div class="filter-content">
                                <ul class="filter-list">
                                    @foreach($good->sizes as $size)
                                        <li>
                                            <input type="checkbox" value="{{$size->id}}" name="sizes[]" id="filter-size-{{$size->id}}" form="create-good">
                                            <label for="filter-size-{{$size->id}}">{{$size->name}}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="float-right col-md-3 mx-4">
                            <div class="filter-title">Материал:</div>
                            <div class="filter-content">
                                <ul class="filter-list">
                                    @foreach($good->materials as $material)
                                        <li>
                                            <input type="checkbox" value="{{$material->id}}" name="materials[]" id="filter-material-{{$material->id}}" form="create-good">
                                            <label for="filter-material-{{$material->id}}">{{$material->name}}</label>
                                        </li>
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
                </div>
            </form>

            <form id="delete-good" method="POST" action="{{ route('good.delete', [ 'good_id' => $good->id ]) }}">
                {{ csrf_field() }}
                <button form="delete-good" type="submit" class="btn pt-0 pb-1 small-button btn-danger">Удалить</button>
            </form>
        </div>
    </div>
</div>

@endsection('content')
