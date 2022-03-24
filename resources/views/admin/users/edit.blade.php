@extends('adminlte::page')

@section('title', 'Usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::model($user,['route'=>['admin.users.update',$user],'method'=>'put','autocomplete'=>"off"]) !!}
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
        
         @foreach ($roles as $role)
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]', $role->id,null, ['class'=>'mr-1 mt-2']) !!}
                            {{$role->name}}
                        </label>
                    </div>
                @endforeach

        {!! Form::submit('Actualizadar Usuario', ['class'=>'btn btn-primary']) !!}
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
  title: 'El Usuario ha sido Actualizado',
  showConfirmButton: false,
  timer: 2300
})

</script>
@endif
@stop