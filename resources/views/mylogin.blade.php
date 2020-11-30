@extends('layout')
@section('titlesection')Войти
@endsection
@section('content')
<div class="wrapper">
    <div class="header">
        <div class="container">
            <h2>Авторизуйтесь</h2>
        </div>
    </div>

    <div class="form">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">{{ csrf_field() }}
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">

            <a class="float-right" href="#">Зарегистрироваться</a>

            @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Зарегистрироваться</a>
            @endif

        </div>
            <div class="form-group">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Email" name="email">
                        @error('email')
                            {{$message}}
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" placeholder="Пароль" name="password">
                        @error('password')
                            {{$message}}
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Запомнить
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default btn-sm">Войти</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
