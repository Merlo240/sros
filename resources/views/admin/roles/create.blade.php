@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Crear Rol</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.roles.store','autocomplete'=>"off"]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Nombre') !!}
            {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'ingrese el nombre']) !!}
            @error('name')
            <small class="malr text-danger">*{{$message}}</small>
        @enderror
        </div>
        <h2 class="h3"> Listado de Permisos</h2>
        @foreach ($permissions as $permission)
            <div>
                <label>
                    {!! Form::checkbox('permissions[]',$permission->id, null ,['class ' =>'mr-1']) !!}
                    {{$permission->description}}
                </label>
            </div>
        @endforeach
        
            {!! Form::submit('Crear Rol', ['class'=>'btn btn-primary']) !!}
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
  title: 'El Rol ha sido Creado',
  showConfirmButton: false,
  timer: 2300
})

</script>


@endif
@stop