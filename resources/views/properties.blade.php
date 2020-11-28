@extends('layout')
@section('titlesection')Группы свойств
@endsection
@section('content')
<div class="wrapper">
    <div class="header">
        <div class="container">
            <h2>Изменение свойств</h2>
        </div>
    </div>

    <div class="form">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('update_props') }}">{{ csrf_field() }}
            <div class="form-group row">
                <div class="float-right col-md-5 mx-4">
                    <div class="row">
                        <div class="filter-title">Удалить отмеченные размеры?</div>
                        <input type="checkbox" onclick="ShowHideDiv(this)" value="" name="" id="sizes">
                        <script type="text/javascript">
                            function ShowHideDiv(open) {
                                let what = "del-" + this.event.target.id;
                                let where;
                                if(this.event.target.id == "sizes") {
                                    where = "#"+what+" input"}
                                if(this.event.target.id == "mats") {
                                    where = "#"+what+" input"}
                                let delsizes_ul = document.getElementById(what);
                                let delsizes_list = document.querySelectorAll(where);
                                delsizes_ul.style.display = open.checked ? "block" : "none";
                                delsizes_list.forEach(
                                    function(currentValue, currentIndex, listObj) {
                                        currentValue .removeAttribute("disabled");
                                });
                            }
                        </script>
                    </div>
                    <div id="del-sizes" style="display: none" class="filter-content">
                        <ul>
                        @foreach($sizes as $size)
                            <li>
                                <input type="checkbox" id="filter-size-{{$size->id}}" disabled value="{{$size->id}}" name="sizes[]" form="create-good-form">
                                <label for="filter-size-{{$size->id}}">{{$size->name}}</label>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="float-right col-md-5 mx-4">
                    <div class="row">
                        <div class="filter-title">Удалить отмеченные материалы?</div>
                        <input type="checkbox" onclick="ShowHideDiv(this)" value="" name="" id="mats">
                    </div>
                    <div id="del-mats" style="display: none" class="filter-content">
                        <ul>
                        @foreach($materials as $material)
                            <li>
                                <input type="checkbox" id="filter-material-{{$material->id}}" disabled="disabled" value="{{$material->id}}" name="materials[]" form="create-good-form">
                                <label for="filter-material-{{$material->id}}">{{$material->name}}</label>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Добавить материал</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Имя материала" name="material-name">
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Код материала" name="material-code">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Добавить размер</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Имя размера" name="size-name">
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Код размера" name="size-code">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default btn-sm">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
