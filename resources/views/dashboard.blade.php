@extends('layout')
@section('titlesection')Администрирование
@endsection
@section('content')
<div class="wrapper">
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col">
            <h2>Административная Панель</h2>
        </div>
            <div class="row">
                <div class="col py-1 border border-black">
                    <a href="{{ route('good.new') }}">
                        <button class="btn pt-0 pb-1" type="submit">+ Создать товар</button></a>
                </div>
                <div class="col py-1 border border-black">
                    <a href="{{ route('props') }}">
                        <button class="btn pt-0 pb-1" type="submit">Группы свойств</button></a>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-striped table-dark">
        <thead>
        <tr scope="row">
            <th scope="col" class="col-05 border border-white">id</th>
            <th scope="col" class="col-2 border border-white">Действия</th>
            <th scope="col" class="col-3 border border-white">Название</th>
            <th scope="col" class="col-2 border border-white">Размеры</th>
            <th scope="col" class="col-2 border border-white">Материалы</th>
            <th scope="col" class="col-3 border border-white">Фото</th>
        </tr>
        </thead>
        <tbody>
        @foreach($goods as $good)
        <tr>
            <td class="border border-white">{{ $good->id }}</td>
            <td class="align-middle border border-white" >
                <a href="{{ route('good.edit', ['good_id' => $good->id]) }}" style="text-decoration: none;">
                    <div style="width: 12em;
                        display:flex; flex-direction: column; height: 8em;"
                         class="btn pt-0 pb-1 btn-warning">Редактировать</div>
                </a>
            </td>
            <td class="border border-white">{{ $good->name }}</td>
            <td class="border border-white">{{ $good->sizes()->get()->pluck('name')->implode(', ') }}</td>
            <td class="border border-white">{{ $good->materials()->get()->pluck('name')->implode(', ') }}</td>
            <td class="border border-white">
                <div class=""><img style="width: 8em;" src="{{$good->image}}" alt="{{$good->code}}"></div>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>        <div class="text-center"> {{ $goods->links() }} </div>
</div>
@endsection
