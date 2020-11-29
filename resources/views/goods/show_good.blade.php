@extends('layout')
@section('titlesection')Редактировать
@endsection
@section('content')

<div class="wrapper">
    <div class="header">
        <div class="container">
            <h2>Товар {{$good->id}} </h2>
        </div>
    </div>

    <div class="wrap">
        <div class="form container">
            <form id="update-good"class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="form-group">
                        <label id="name" class="col-m-2 control-label">Имя: {{$good->name}})</label>
                        <div class="col-sm-10">
                            <label for="name" class="col-m-2">код: {{ $good->code }}</label><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Фото</label>
                    </div>

                    <div id="img1" class=""><img class="img-fluid" src="{{ asset($good->image) }}"><br></div>
                    <label for="img1">{{$good->image}}</label>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Цена: {{$good->price}})</label>
                    </div>

                    <div class="form-group row">
                        <div class="float-right col-md-5 mx-4">
                            <div class="filter-title">Доступные размеры:</div>
                            <div class="filter-content">
                                <ul class="filter-list">
                                    @foreach($good->sizes as $size)
                                        <li>
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
                                            <label for="filter-material-{{$material->id}}">{{$material->name}}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection('content')
