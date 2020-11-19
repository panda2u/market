

<div class="navbar navbar-expand-md navbar-dark bg-dark mb-4" role="navigation">
    <a class="navbar-brand" href="{{url('')}}">Главная</a>
    @if ($isadm == 1)
        <a class="navbar-brand mr-auto" href="{{url('/catalog')}}">Каталог</a>
    @else
        <a class="navbar-brand" href="{{url('/catalog')}}">Каталог</a>
        <a class="navbar-brand mr-auto" href="{{url('/prelogin')}}">Войти</a>
    @endif
    <ul class="navbar-nav float-right">
        <li class="nav-item active">
            @if ($isadm == 1)
                <a class="navbar-brand" href="{{url('')}}">[админ.: {{$name}}] Выйти</a>
            @else
                <a class="navbar-brand" href="{{url('/pma')}}">Административная Панель</a>
            @endif
        </li>
    </ul>
</div>

