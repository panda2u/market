@extends('layout')
@section('titlesection')Товар
@endsection
@section('content')

<div class="wrapper">
    <div class="header">
        <div class="container">
            <h2>#{{$good->id}}: {{$good->name}}</h2>
        </div>
    </div>


    <div class="wrap">
        <div class="form container">
            <div id="update-good" class="form-horizontal">

                <div class="form-group row">

                    <div id="img1" class="float-left col">
                        <img class="img-fluid" src="{{ asset($good->image) }}" alt="{{$good->image}}"><br>
                    </div>

                    <div class="float-left col">
                        <label class="col-sm-4 control-label">Цена: {{$good->price}}</label>
                    </div>

                </div>

                    <div class="form-group row">
                        <div class="col-md-5 mx-4">
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
        </div>
    </div>
</div>

@endsection('content')
