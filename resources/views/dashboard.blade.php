@extends('layout')
@section('titlesection')admin
@endsection
@section('content')
<div class="wrapper">
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col">
            <h2>Административная Панель</h2>
        </div>
                <div class="col py-1 border border-black">
                    <a href="{{ url('/good/new') }}"><button class="btn pt-0 pb-1 small-button" type="submit">+ Создать</button></a>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-striped table-dark">
        <thead>
        <tr scope="row">
            <th scope="col" class="index-id border border-white">id</th>
            <th scope="col" class="w-25 border border-white">Название</th>
            <th scope="col" class="mw-6em border border-white">Цена</th>
            <th scope="col" class="border border-white">Фото</th>
            <th scope="col" class="mw-15em border border-white">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($goods as $good)
        <tr>
                <td class="border border-white">{{ $good->id }}</td>
                <td class="border border-white">{{ $good->name }}</td>
                <td class="border border-white">{{ $good->price }}</td>
                <td class="border border-white">{{ $good->image }}</td>
                <td class="py-1.5">
                    <a href="{{ url('/goods/'.$good->id) }}">
                        <button class="btn pt-0 pb-1 small-button btn-warning">Изменить</button></a>
                    <button class="btn pt-0 pb-1 small-button btn-danger">Удалить</button>
                </td>
        </tr>
        @endforeach

        </tbody>
    </table>        <div class="text-center"> {{ $goods->links() }} </div>
</div>
@endsection
