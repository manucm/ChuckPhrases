<html>
  <head>
    <title>Chuck Norris Jokes</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
  </head>
  <body>
      <div class="container-fluid">
          <nav class="navbar navbar-inverse">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>

                <a class="navbar-brand" href="{{ url('/') }}">Chuck Norris</a>
                </div>
            
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                  @if($usuarioConectado)
                  <li class="active"><a href="{{ url('/jokes') }}">Administración Chistes <span class="sr-only">(current)</span></a></li>
                    
                    </li>
                    @endif
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@if($usuarioConectado) {{ $usuarioConectado->username }} @else Login @endif <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                          @if(!$usuarioConectado)
                      <li><a href="{{ url('login') }}">Login</a></li>
                        @else
                      <li><a href="{{ url('logout')}}">Logut</a></li>
                        @endif
                        {{-- 
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Login OAuth</a></li>--}}
                      </ul>
                    </li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
    
            <div id="container">
              @yield('content')
            </div>
    
      </div>

      <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
              </div>
              <div class="modal-body">
                <p>Some text in the modal.</p>
              </div>
              <div class="modal-footer">
                  <button id="delete-on" type="button" class="btn btn-success" data-backdrop="static" data-keyboard="false">Aceptar</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                
                
              </div>
            </div>
        
          </div>
        </div>
      
    <script src="/js/app.js"></script>
  </body>
</html>