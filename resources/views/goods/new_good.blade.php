@extends('layout')
@section('titlesection')Создать
@endsection
@section('content')

<div class="wrapper">
    <div class="header">
        <div class="container">
            <h2>Создание товара</h2>
        </div>
    </div>

    <div class="wrap">
        <div class="form container">
            <form method="POST" action="{{ route('good.create') }}" class="form-horizontal" id="create-good" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Имя</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Имя" name="name" form="create-good">
                        @error('name')
                        {{$message}}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Код</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="" name="code" form="create-good">
                        @error('code')
                        {{$message}}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Цена</label>
                    <div class="col-sm-10">
                        <input class="form-control" placeholder="Цена" name="price" required form="create-good">
                        @error('price')
                        {{$message}}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Фото</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" placeholder="Фото" name="image" accept="image/*" form="create-good">
                        @error('image')
                        {{$message}}
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="float-right col-md-5 mx-4">
                        <div class="filter-title">Укажите доступные размеры:</div>
                        <div class="filter-content">
                            <ul class="filter-list">
                    @foreach($sizes as $size)
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
                    @foreach($materials as $material)
                        <li>
                            <input type="checkbox" value="{{$material->id}}" name="materials[]" id="filter-material-{{$material->id}}" form="create-good">
                            <label for="filter-material-{{$material->id}}">{{$material->name}}</label>
                        </li>
                    @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

{{--                <div class="col-5 text-center border border-black float-right">
                    <button type="submit" class="col-6 float-left btn pt-0 pb-1 small-button" form="create-good">Создать!</button>
                </div>--}}

                <div class="col-7 text-center border">
                    <button type="submit" class="col-7 float-right btn pt-0 pb-1 small-button" form="create-good">Создать!</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
