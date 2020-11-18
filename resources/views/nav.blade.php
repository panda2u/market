

<div class="navbar navbar-expand-md navbar-dark bg-dark mb-4" role="navigation">
    <a class="navbar-brand" href="{{url('')}}">Главная</a>
    <a class="navbar-brand" href="{{url('/catalog')}}">Каталог</a>
    <a class="navbar-brand mr-auto" href="{{url('/admin')}}">Add.min.pannel</a>
    <ul class="navbar-nav float-right">
        <li class="nav-item active">
            @if ($isadm == 1)
                <a class="navbar-brand" href="{{url('')}}">Выйти</a>
            @else
                <a class="navbar-brand" href="{{url('/admin')}}">Административная Панель</a>
            @endif
        </li>
    </ul>
</div>

