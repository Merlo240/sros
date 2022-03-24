<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Municipalidad De San Roque </title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
</head>
<body>
    <!-- Image and text -->
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <img src="{{ asset('logo-municipalidada.png') }}" width="35" height="35" class="d-inline-block align-top" alt="">
      Visor de Obras
    </a>
    <div class="form-inline">
        @if (Route::has('login'))
                @auth
                    <a href="{{ url('/admin') }}" class="btn btn-primary mr-sm-2">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary mr-sm-2">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-secondary mr-sm-2">Registrarse</a>
                    @endif
                @endauth
           
        @endif
      </div>
  </nav>
  

  <div class="container">
    <div class="m-2">
        @include('admin.bacheos.map')
    </div>    
  </div>
   

    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>