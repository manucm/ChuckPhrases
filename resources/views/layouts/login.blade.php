@extends('layouts.template')

@section('content')

<div class="col-sm-12 col-md-6 col-md-offset-3">
    <div class="panel panel-primary">
      <div class="panel-heading">Login</div>
        <div class="panel-body center">
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

            <form class="" action="{{ url('login') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group @if($errors->has('username')) has-danger @elseif (old('username')) has-success @else @endif">
                    <label class="form-control-label" for="username">Usuario</label>
                    <input type="text" class="form-control @if($errors->has('username')) form-control-danger @else form-control-success @endif"  id="username" name="username" value="{{ old('username') }}">
                    @if($errors->has('username'))<div class="form-control-feedback">{{ $errors->first('username') }}</div>@endif
                    {{-- <small class="form-text text-muted">Example help text that remains unchanged.</small>--}}
                </div>
                <div class="form-group @if($errors->has('password')) has-danger @elseif (old('password')) has-success @else @endif">
                  <label class="form-control-label" for="password">Contraseña</label>
                  <input  type="password" class="form-control @if($errors->has('password')) form-control-danger  @endif" id="password" name="password" >
                  @if($errors->has('password'))<div class="form-control-feedback">{{ $errors->first('password') }}</div>@endif
                  {{--<small class="form-text text-muted">Example help text that remains unchanged.</small>--}}
                </div>
                <button type="submit" class="btn btn-success pull-sm-right">login</button>
            </form>
          
              </div>
        </div>
      </div>
    

    @endsection

