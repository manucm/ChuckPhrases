@extends('layouts.template')

@section('content')

<div class="listado-component">
    <div class="panel panel-primary">
      <div class="panel-heading">Listado de Bromas del tío Chuck!!</div>
        <div class="panel-body">
            <table id="table-component" class="table">
                <thead>
                  <tr>
                    <th>Texto</th>
                    <th>Owner</th>
                    <th>Visitas</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
              </table>
        </div>
      </div>
</div>


@endsection