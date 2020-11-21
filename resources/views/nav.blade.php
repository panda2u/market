<div class="navbar navbar-expand-md navbar-dark bg-dark" role="navigation">
    <a class="navbar-brand" href="{{url('')}}">Главная</a>

        <a class="navbar-brand" href="{{url('/catalog')}}">Каталог</a>
        <a class="navbar-brand mr-auto" href="{{url('/dashboard')}}">Административная Панель</a>

    <ul class="navbar-nav float-right">
        <li class="nav-item active">
            @auth
                <a class="navbar-brand" href="{{url('logout')}}">[{{$name}}] Выйти</a>
            @else
                <a class="navbar-brand" href="{{url('login')}}">[Войти]</a>
            <!-- endif -->
            @endauth
        </li>
    </ul>
</div>

