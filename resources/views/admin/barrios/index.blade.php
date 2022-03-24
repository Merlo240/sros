@extends('adminlte::page')

@section('title', 'Barrio')
@section('css')
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
@stop

@section('content_header')
@can('admin.barrios.create')
<a class="btn btn-secondary float-right " href="{{route('admin.barrios.create')}}">Agregar Barrio</a>
@endcan

    <h1>Lista de Barrios</h1>
@stop
@section('content_header')
<h1>Lista de Barrios</h1>
@stop

@section('content')
@if (session('creacion'))
    <div class="alert alert-success"> 
        <strong>{{session('creacion')}}</strong>
    </div>
@endif
@if (session('Delete'))
    <div class="alert alert-success">
        <strong>{{session('Delete')}}</strong>
    </div> 
@endif
    <div class="card">
            
        <div class="card-body">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th ></th>
                        <th ></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barrios as $barrio)
                    <tr>
                        {{-- <td scope="row"></td> --}}
                        <td>{{$barrio->id}}</td>
                        <td>{{$barrio->name}}</td>
                        <td >@can('admin.barrios.edit')
                            <a href="{{route('admin.barrios.edit',$barrio)}}" class=" btn btn-primary btn-sm">Editar</a>
                        @endcan
                            </td>
                        <td>@can('admin.barrios.destroy')
                            <form action="{{route('admin.barrios.destroy',$barrio)}}" method="post" class="formulario-eliminar">
                                @csrf
                                @method('delete')
                                <button type="submit" class=" btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        @endcan
                            
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
@stop


@section('js')

<script src="{{asset('js/app.js')}}"></script>

@if (session('mensaje')=='ok')
    <script>
        Swal.fire(
            'Eliminado!',
            'El Barrio ha sido eliminado.',
            'success'
            )
    </script>
@endif

    <script>


         $(document).ready( function () {
    $('#myTable').DataTable();



    $('.formulario-eliminar').submit(function(e){
           e.preventDefault();
           Swal.fire({
  title: 'Estas seguro?',
  text: "¡No podrás revertir esto!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: '¡Sí, bórralo!',
}).then((result) => {
  if (result.isConfirmed) {
    this.submit();
  }
})
 });

 });

    </script>
@stop