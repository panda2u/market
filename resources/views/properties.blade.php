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
        <form class="form-horizontal" role="form" method="POST" id="update-props" action="{{ url('update_props') }}">{{ csrf_field() }}
            <div class="form-group row">
                <div class="float-right col-md-5 mx-4">
                    <div class="row">
                        <div class="filter-title">Удалить отмеченные размеры?</div>
                        <input type="checkbox" onclick="enabling(this)" value="" name="" id="sizes">
                        <script type="text/javascript">
                            function enabling() {
                                let selector;
                                if(this.event.target.id == "sizes") {
                                    selector = "#"+"del-" + this.event.target.id+" input"}
                                if(this.event.target.id == "mats") {
                                    selector = "#"+"del-" + this.event.target.id+" input"}
                                let del_list = document.querySelectorAll(selector);
                                del_list.forEach( function(current) {
                                    if (current.hasAttribute("disabled"))
                                        current.removeAttribute("disabled");
                                    else current.setAttribute("disabled", "true");
                                });
                            }
                        </script>
                    </div>
                    <div id="del-sizes" style="display: block" class="filter-content">
                        <ul>
                        @foreach($sizes as $size)
                            <li>
                                <input type="checkbox" name="sizes[]" id="filter-size-{{$size->id}}" disabled value="{{$size->id}}" form="update-props">
                                <label for="filter-size-{{$size->id}}">{{$size->name}}</label>
                                <label class="float-right" for="filter-size-{{$size->id}}">({{$size->code}})</label>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="float-right col-md-5 mx-4">
                    <div class="row">
                        <div class="filter-title">Удалить отмеченные материалы?</div>
                        <input type="checkbox" onclick="enabling(this)" value="" name="" id="mats">
                    </div>
                    <div id="del-mats" style="display: block" class="filter-content">
                        <ul>
                        @foreach($materials as $material)
                            <li>
                                <input type="checkbox" name="materials[]" id="filter-material-{{$material->id}}" disabled="disabled" value="{{$material->id}}" form="update-props">
                                <label for="filter-material-{{$material->id}}">{{$material->name}}</label>
                                <label class="float-right" for="filter-size-{{$material->id}}">({{$material->code}})</label>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Добавить/обновить размер</label>
                    <div class="col-sm-10">
                        <input type="text" name="size-name" class="form-control" placeholder="Имя размера">
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="size-code" class="form-control" placeholder="Код размера">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Добавить/обновить материал</label>
                    <div class="col-sm-10">
                        <input type="text" name="material-name" class="form-control" placeholder="Имя материала">
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="material-code" class="form-control" placeholder="Код материала">
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
