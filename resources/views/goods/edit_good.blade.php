@extends('layout')
@section('titlesection')Создать
@endsection
@section('content')
<h2>Редактирование товара {{$good->id}} </h2>
<div class="form">
    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('good.create') }}">
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
                <label class="col-sm-2 control-label">Новое фото:</label>
                <div class="col-sm-10">
                    <input id="img2" type="file" class="form-control" placeholder="" name="image">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Цена: ({{$good->price}})</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="" name="price">
                </div>
            </div>





            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default btn-sm">Сохранить</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection('content')
