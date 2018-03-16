@extends('layouts.template')

@section('content')

<div id="random-component">
  <div class="jumbotron">
    <h1>El chiste elegido!!!</h1>
    <p id="random-joke"></p>
    <p id="random-data"><img src="" alt=""> <span></span></p>
  </div>
</div>

<div id="random-panel" class="panel">
  <div class="panel-heading">
    <h4>Apariciones</h4>
  </div>
  <div class="panel-body">
    {{--
      <div class="slidecontainer">
          <p>Ponle nota:</p>
          <input type="range" min="1" max="10" value="0" class="slider" id="myRange">
        </div>
        <br >
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Nota</span>
            <input disabled type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" value="0">
          </div> --}}
  </div>
</div>



@endsection