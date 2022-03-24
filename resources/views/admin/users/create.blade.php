@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Agregar Usuario</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.users.store','autocompleta'=>'off']) !!}
        <div class="form-group">
            {!! Form::label('name','Nombre') !!}
            {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'Ingrese el Nombre']) !!}
            @error('name')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('email','Correo') !!}
            {!! Form::email('email', null, ['class'=>'form-control','placeholder'=>'Ingrese el Correo']) !!}
            @error('email')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>
        
        <div class="form-group">
            {!! Form::label('password','Contraseña') !!}
            {!! Form::text('password', null, ['class'=>'form-control','placeholder'=>'Ingrese la Contraseña']) !!}
            @error('password')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>
        {!! Form::submit('Crear Usuario', ['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>

@stop



@section('js')

<script src="{{asset('js/app.js')}}"></script>

@if (session('mensaje')=='ok')
<script>
    Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'El Usuario ha sido Creado',
  showConfirmButton: false,
  timer: 2300
})

</script>


@endif
@stop