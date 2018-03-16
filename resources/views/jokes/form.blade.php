@extends('layouts.template')

@section('content')

<div class="container-fluid">
    <div class="panel panel-primary">
      <div class="panel-heading">Formulario de Bromas</div>
<div class="panel-body">
        @if ($errors->any())
        <div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
              <ul class="list-unstyled">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
      @if($action == 'create')
          {!! Form::open(['method' => 'POST', 'url' => url('/jokes/create')]) !!}
      @else
          {!! Form::open(['method' => 'PUT', 'url' => url('/jokes/' . $joke->slug)]) !!}
      @endif
      <div class="container-fluid">
          <div class="form-group col-sm-12">
              {!! Form::label('value', 'Broma') !!}
              {!! Form::textArea('value', $joke->value? $joke->value : '', ['class' => 'form-control', 'id' => 'value']) !!}
          </div>
  
          <div class="form-group col-sm-12">
              {!! Form::label('category_id', 'Categoria') !!}
              {!! Form::select('category_id', ['' => ''] + $categories->toArray() , $joke->categories, ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'recorrido']) !!}
          </div>
          
  
      </div>
          <button type="submit" class="btn btn-success pull-right">guardar</button>
      
  
      {!! Form::close() !!}
    </div>
      </div>
</div>


@endsection