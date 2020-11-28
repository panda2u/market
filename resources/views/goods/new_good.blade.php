@extends('layout')
@section('titlesection')Создать
@endsection
@section('content')

@isset($image_path)
    @if($image_path != 'default')
        <img class="img-fluid" src="{{ asset($image_path) }}"><br>
        {{$image_path}}
    @else
        @error('image')
            <span>{{$message}}</span>
        @enderror
    @endif
@endisset

<div class="wrapper">
    <div class="header">
        <div class="form container">
            <h2>Создание товара</h2>
            <form method="POST" action="{{ route('good.create') }}" class="form-horizontal" id="create-good-form" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Имя</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Имя" name="name" required form="create-good-form">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Цена</label>
                    <div class="col-sm-10">
                        <input class="form-control" placeholder="Цена" name="price" required form="create-good-form">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Фото</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" placeholder="Фото" name="image" accept="image/*" form="create-good-form">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="float-right col-md-5 mx-4">
                        <div class="filter-title">Укажите доступные размеры:</div>
                        <div class="filter-content">
                            <ul class="filter-list">
                    @foreach($sizes as $size)
                        <li>
                            <input type="checkbox" value="{{$size->id}}" name="sizes[]" id="filter-size-{{$size->id}}" form="create-good-form">
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
                    @foreach($materials as $material)
                        <li>
                            <input type="checkbox" value="{{$material->id}}" name="materials[]" id="filter-material-{{$material->id}}" form="create-good-form">
                            <label for="filter-material-{{$material->id}}">{{$material->name}}</label>
                        </li>
                    @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <br>
                    <div class="col-sm-2 col-sm-10">
                        <a class="float-left col-md-3" href="{{ route('dashboard') }}">
                            <button class="btn pt-0 pb-1 small-button">К списку</button></a>
                        <button type="submit" class="float-left mr-4 col-md-3 btn pt-0 pb-1 small-button" form="create-good-form">Создать</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
