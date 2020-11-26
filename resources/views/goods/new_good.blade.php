@extends('layout')
@section('titlesection')Создать
@endsection
@section('content')
<h2>Создание товара</h2>
<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('good.create') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <div class="form-group">
            <label class="col-sm-2 control-label">Имя</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Имя" name="name">

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Цена</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" placeholder="Цена" name="price">

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Фото</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" placeholder="Фото" name="image">

            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default btn-sm">Создать</button>
            </div>
        </div>
    </div>
</form>
<div class="text-center"><a href="{{ route('dashboard') }}">
    <button class="btn pt-0 pb-1 small-button">Очистить</button>
    </a></div>
@endsection
