@extends('layout')
@section('titlesection')Текстиль
@endsection
@section('content')
<div class="wrapper">
    <div class="header">
        <div class="container">
            <h2>Главная Страница</h2>
            @isset($path)
                <img class="img-fluid" src="{{ asset('storage/'.$path) }}">
            @else
                <span>no file loaded</span>
            @endisset
        </div>
    </div>
</div>
@endsection
