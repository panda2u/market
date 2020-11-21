@extends('layout')
@section('titlesection')admin
@endsection
@section('content')
<div class="wrapper">
    <div class="header">
        <div class="container">
            <h2>Административная Панель</h2>
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
                    <button class="btn p-0 small-button btn-warning">Изменить</button>
                    <button class="btn p-0 small-button btn-danger">Удалить</button>
                </td>
        </tr>
        @endforeach
        <tr>
                <td class="border border-white">1</td>
                <td class="border border-white">Mark</td>
                <td class="border border-white">Otto</td>
                <td class="border border-white">@mdo</td>
                <td class="py-1.5">
                    <button class="btn p-0 small-button btn-warning">Изменить</button>
                    <button class="btn p-0 small-button btn-danger">Удалить</button>
                </td>
        </tr>
        <tr>
                <td scope="row" class="border border-white">2</td>
                <td class="border border-white">Jacob</td>
                <td class="border border-white">Thornton</td>
                <td class="border border-white">@fat</td>
                <td class="border border-white">Btn1 Btn2</td>
        </tr>

        </tbody>
    </table>        {{ $goods->links() }}
</div>
@endsection
